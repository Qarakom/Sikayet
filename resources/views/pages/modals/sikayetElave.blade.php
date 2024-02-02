<div class="modal fade" id="sikayetElave" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form action="{{ route('sikayet.elave') }}" method="post" name="sikayetElave" id="sikayetElave">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Şikayət Əlavə Et</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

                <div class="form-group">
                  <label for="movuz">Mövzu</label>
                  <input type="text" class="form-control" id="movzu" name="movzu">
                </div>
                <div class="form-group">
                  <label for="metn">Şikayətiniz</label>
                  <textarea class="form-control" id="metn" name="metn"></textarea>
                </div>
                <div class="form-group">
                    <label for="operator">Operator</label>
                    <select class="form-control" id="operator" name="operator">
                        @foreach($operators as $operatorId => $operatorAd)
                        <option value="{{ $operatorId }}">{{ $operatorAd }}</option>
                    @endforeach
                    </select>
                  </div>
                <div class="form-group">
                    <label for="fayl">Fayl</label>
                    <input type="text" class="form-control" id="fayl" name="fayllar">
                </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Bağla</button>
          <button type="sumbit" class="btn btn-primary">Əlavə Et</button>
        </div>
    </form>
      </div>
    </div>
  </div>


