<!-- Upload Document Modal -->
<div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadModalLabel">Upload dokumenta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert" id="message2" style="display: none"></div>
                </div>
            </div>
            <form method="post" enctype="multipart/form-data" id="uploadForm">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="doc_type">Tip dokumenta</label>
                        <select name="doc_type" id="doc_type" class="form-control">
                            @foreach($doc_types as $type)
                                <option value="{{  $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="doc_file">Odabir dokumenta</label>
                        <input type="file" name="doc_file" id="doc_file" class="form-control">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Document Modal -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Uredi dokument</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="alert" id="editModalErrMsg" style="display: none"></div>
                </div>
            </div>
            <form method="post" enctype="multipart/form-data" id="editForm">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-group">
                        <label for="doc_type">Tip dokumenta</label>
                        <select name="doc_type" id="doc_type" class="form-control edit-select">
                            @foreach($doc_types as $type)
                                <option value="{{  $type->id }}">{{ $type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="doc_file">Odabir dokumenta</label>
                        <input type="file" name="doc_file" id="doc_file" class="form-control">
                    </div>
                    <input type="hidden" id="edit_id" name="edit_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Zatvori</button>
                    <button type="submit" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>