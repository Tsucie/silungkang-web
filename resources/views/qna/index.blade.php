@extends('layouts.app')

@section('content')
<!-- .modal -->
<div class="modal fade" id="AddEditModal" tabindex="-1" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal">
          @csrf
          <div class="box-body">
            <div class="form-group">
                <label for="fullname">Nama Customer</label>
                <div class="col-sm-12">
                  <input class="form-control form-inputs" type="text" name="fullname" id="fullname" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email Customer</label>
                <div class="col-sm-12">
                  <input class="form-control form-inputs" type="email" name="email" id="email" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="question">Pertanyaan</label>
                <div class="col-sm-12">
                  <textarea class="form-control form-inputs" name="question" id="question" disabled></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="answer">Jawaban</label>
                <div class="col-sm-12">
                  <textarea class="form-control form-inputs" name="answer" id="answer" rows="5" disabled></textarea>
                </div>
                </div>
            <div class="form-group">
                <label for="msg_date">Tanggal</label>
                <div class="col-sm-12">
                  <input type="datetime" class="form-control form-inputs" name="msg_date" id="msg_date" disabled>
                </div>
            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal -->

<!-- .modal-dialog -->
<div class="modal fade" id="DeleteModal" tabindex="-1" role="dialog" aria-labelledby="DeleteModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="DeleteModalTitle">Hapus Pertanyaan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger" id="btn-hps" data_id="" onclick="Delete(this)">Hapus</button>
      </div>
    </div>
  </div>
</div>
<!-- /.modal-dialog -->

<div class="header bg-gradient-info pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid mt--7">
    <div class="row">
        <div class="col">
            <div class="card bg-default shadow shadow-dark">
                <!-- Card header -->
                <div class="card-header bg-transparent border-0">
                    <h3 class="text-white mb-0">Pertanyaan Customer</h3>
                </div>
                <!-- Dark table -->
                <div class="table-responsive">
                    <table class="table align-items-center table-dark table-flush">
                    <thead class="thead-dark">
                        <tr>
                        <th scope="col" class="sort" data-sort="name">Nama Customer</th>
                        <th scope="col" class="sort" data-sort="email">Email</th>
                        <th scope="col" class="sort" data-sort="text">Pertanyaan</th>
                        <th scope="col" class="sort" data-sort="created">Tanggal Pesan</th>
                        <th scope="col" class="sort" data-sort="action">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @forelse ($data as $item)
                            <tr>
                                <td class="name">{{ $item->fullname }}</td>
                                <td class="email">{{ $item->email }}</td>
                                <td class="text">{{ $item->message_text }}</td>
                                <td class="created">{{ $item->message_date }}</td>
                                <td class="action">
                                    <a class="btn btn-sm btn-info btn-table" data-toggle="tooltip" data-html="true" title="Lihat Detail Data" id="btndetail{{ $loop->index }}" role="button" data_id="{{ $item->message_id }}" data_nama="{{ $item->fullname }}" onclick="ShowDetails(this)">Detail Pertanyaan</a>
                                    {{-- <a class="btn btn-sm btn-danger btn-table" data-toggle="tooltip" data-html="true" title="Hapus Data" id="btndelete{{ $loop->index }}" role="button" data_id="{{ $item->message_id }}" data_name="{{ $item->fullname }}" onclick="DeleteQnA(this)">Hapus</a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">
                                    <h4 style="text-align: center; color: white;">Tidak ada Data</h4>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                    {{-- Pagination --}}
                    <div class="card-footer bg-transparent d-flex justify-content-end">
                        {!! $data->links() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footers.auth')
</div>
@endsection

@push('js')
  <script src="{{ asset('assets') }}/js/QnA.js"></script>
@endpush