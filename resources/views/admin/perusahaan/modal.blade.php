<!-- Button trigger modal -->
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import File Excel</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        {{-- <form action="{{ route('admin.perusahaan.import_proses') }}" method="post" enctype="multipart/form-data"> --}}
          @csrf
          {{ csrf_field()}}
        <div class="modal-body">
            <div class="form-group">
                <div class="form-group">
                    <input type="file" name="file" required="required">
                </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Selesai</button>
          <button type="button" class="btn btn-primary">Import</button>
        </div>
      </form>
      </div>
    </div>
  </div>