<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PromoResource;
use App\Models\Promo;
use App\Models\ResponseMessage;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PromoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = $this->selectList();
        return view('promo.index', compact('data'));
    }

    /**
     * Return a list of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getList()
    {
        $datas = $this->selectList();
        return response()->json($datas);
    }

    /**
     * Get a list of the resource from database.
     *
     * @return array $datas
     */
    private function selectList()
    {
        $rawDatas = DB::select(
            "SELECT prm.*,".
                " (SELECT pdct_nama FROM products WHERE pdct_id=prm.prm_pdct_id) AS pdct_nama,".
                " (SELECT pdct_harga FROM products WHERE pdct_id=prm.prm_pdct_id) AS pdct_harga,".
                " (SELECT pp_filename FROM product_photos WHERE pp_pdct_id=prm.prm_pdct_id LIMIT 1) AS pp_filename,".
                " (SELECT pp_photo FROM product_photos WHERE pp_pdct_id=prm.prm_pdct_id LIMIT 1) AS pp_photo,".
                " (SELECT vnu_nama FROM venues WHERE vnu_id=prm.prm_vnu_id) AS vnu_nama,".
                " (SELECT vnu_harga FROM venues WHERE vnu_id=prm.prm_vnu_id) AS vnu_harga,".
                " (SELECT vp_filename FROM venue_photos WHERE vp_vnu_id=prm.prm_vnu_id LIMIT 1) AS vp_filename,".
                " (SELECT vp_photo FROM venue_photos WHERE vp_vnu_id=prm.prm_vnu_id LIMIT 1) AS vp_photo".
            " FROM promos prm;"
        );
        $datas = [];
        foreach ($rawDatas as $data)
        {
            $data->nama = $data->pdct_nama ?? $data->vnu_nama;
            $data->harga = $data->pdct_harga ?? $data->vnu_harga;
            $data->filename = $data->pp_filename ?? $data->vp_filename;
            $data->photo =
                // Mengembalikan nilai null atau base64String
                ($data->pp_photo == null ? null : base64_encode($data->pp_photo))
                ?? // OR
                // Mengembalikan nilai null atau base64String
                ($data->vp_photo == null ? null : base64_encode($data->vp_photo));
            // Unset Unused property from object
            unset($data->pdct_nama);
            unset($data->vnu_nama);
            unset($data->pdct_harga);
            unset($data->vnu_harga);
            unset($data->pp_filename);
            unset($data->vp_filename);
            unset($data->vp_photo);
            unset($data->pp_photo);
            array_push($datas, $data);
        }

        return $datas;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $resmsg = new ResponseMessage();
        $request->validate([
            'nama' => 'required',
            'desc' => 'required',
            'diskon' => 'required',
            'harga' => 'required'
        ]);

        try
        {
            if (!$request->has('pdct_id') && !$request->has('vnu_id'))
                throw new Exception("Data Tidak Lengkap", 0);
            
            $hargaPromo = (double)$request->harga - ((double)$request->harga * (double)$request->diskon / (double)100);
            $promoData = [
                'prm_id' => rand(0,2147483647),
                'prm_pdct_id' => $request->has('pdct_id') ? $request->pdct_id : null,
                'prm_vnu_id' => $request->has('vnu_id') ? $request->vnu_id : null,
                'prm_nama' => $request->nama,
                'prm_desc' => $request->desc,
                'prm_disc_percent' => $request->diskon,
                'prm_harga_promo' => $hargaPromo,
                'created_by' => auth()->user()->name ?? 'system'
            ];

            Promo::query()->create($promoData);

            $resmsg->code = 1;
            $resmsg->message = 'Promo Berhasil Dibuat';
        }
        catch (Exception $ex)
        {
            if ($ex->getCode() == "23000")
           {
                $resmsg->code = "0";
                $resmsg->message = "Promo sudah ada!";
           }
           else
           {
                // $resmsg->code = 1;
                // $resmsg->message = 'Registrasi Gagal';

                #region Code Testing
                $resmsg->code = $ex->getCode();
                $resmsg->message = $ex->getMessage();
                #endregion
           }
        }

        return response()->json($resmsg);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Data Tidak Valid", 0);

            $promoData = Promo::query()->where('prm_id','=',$id)->get();
            if ($promoData->count() == 0) throw new Exception("Tidak Ada Data", 0);

            return response()->json($promoData);
        }
        catch (Exception $ex)
        {
            // $resmsg->code = 0;
            // $resmsg->message = 'Data Tidak Ditemukan';

            #region Code Testing
            $resmsg->code = $ex->getCode();
            $resmsg->message = $ex->getMessage();
            #endregion

            return response()->json($resmsg);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resmsg = new ResponseMessage();
        $request->validate(['nama' => 'required']);

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Data Tidak Valid", 0);

            $hargaPromo = null;
            if ($request->has('diskon') && $request->has('harga'))
            {
                $hargaPromo = (double)$request->harga - ((double)$request->harga * (double)$request->diskon / (double)100);
            }

            $updatedPromo = [
                'prm_nama' => $request->nama,
                'prm_desc' => $request->has('desc') ? $request->desc : null,
                'prm_disc_percent' => $request->has('diskon') ? $request->diskon : null,
                'prm_harga_promo' => $hargaPromo,
                'updated_by' => auth()->user()->name ?? 'system'
            ];

            Promo::query()->where('prm_id','=',$id)->update($updatedPromo);

            $resmsg->code = 1;
            $resmsg->message = 'Promo Berhasil Diubah';
        }
        catch (Exception $ex)
        {
            // $resmsg->code = 0;
            // $resmsg->message = 'Promo Gagal Diubah';

            #region Code Testing
            $resmsg->code = $ex->getCode();
            $resmsg->message = $ex->getMessage();
            #endregion
        }

        return response()->json($resmsg);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $resmsg = new ResponseMessage();

        try
        {
            if (preg_match("/[A-Za-z]/", $id)) throw new Exception("Data Tidak Valid", 0);

            Promo::query()->where('prm_id','=',$id)->delete();

            $resmsg->code = 1;
            $resmsg->message = 'Promo Berhasil Dihapus';
        }
        catch (Exception $ex)
        {
            // $resmsg->code = 0;
            // $resmsg->message = 'Promo Gagal Dihapus';

            #region Code Testing
            $resmsg->code = $ex->getCode();
            $resmsg->message = $ex->getMessage();
            #endregion
        }

        return response()->json($resmsg);
    }
}
