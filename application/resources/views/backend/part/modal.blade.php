<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <form id="form-invoice" class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <input type="hidden" name="id" id="id" value="0">
            <input type="hidden" name="method" id="method">
            @foreach($model::FORM_FIELD as $keyField => $field)
              <div class="form-group" id="{{ $keyField  }}">
                <label class="control-label col-sm-2" for="{{ $keyField }}">{{ $model::FORM_LABEL[$keyField] }}</label>
                <div class="col-sm-10">
                  @if($field == 'text')
                    <input type="{{$field}}" name="{{$keyField}}" class="form-control" placeholder="{{$model::FORM_LABEL[$keyField]}}">
                  @elseif($field=='email')
                    <input type="email" name="{{$keyField}}" class="form-control" placeholder="{{$model::FORM_LABEL[$keyField]}}">
                  @elseif($field=='date')
                    <input type="text" name="{{$keyField}}" class="form-control datepickerinput" placeholder="{{$model::FORM_LABEL[$keyField]}}">
                  @elseif($field == 'file')
                    <input type="{{$field}}" name="{{$keyField}}" class="form-control" placeholder="{{$model::FORM_LABEL[$keyField]}}">
                  @elseif($field == 'image')
                    <input type="file" name="{{$keyField}}" class="form-control" value="{{@$model->$keyField}}" {{!empty($model->id)?(in_array($keyField,$model::FORM_DISABLED)?'disabled':''):''}} placeholder="{{$model::FORM_LABEL[$keyField]}}">
                    <br>
                    <img src="" width="200" height="150" id="previewImage">
                  @elseif($field == 'select')
                    <select class="form-control" name="{{$keyField}}">
                      @foreach(\App\Helpers\SelectHelper::getSelectList($model::FORM_SELECT_LIST[$keyField]) as $key => $val)
                        <option value="{{ $key }}">{{ $val }}</option>
                      @endforeach
                    </select>
                  @elseif($field == 'texteditor')
                    <textarea class="form-control summernote" id="{{$keyField}}" name="{{$keyField}}">{{@$data->$keyField}}</textarea>
                  @elseif($field == 'textarea')
                    <textarea class="form-control" placeholder="{{@$data->$keyField}}" name="{{$keyField}}">{{@$data->$keyField}}</textarea>
                  @endif
                  <div id="{{ $keyField }}_error" class="help-block help-block-error"> </div>
                </div>
              </div>
            @endforeach
          </form>
        </div>
        <div class="modal-footer">
          <button id="submit" type="submit" class="btn btn-primary">Simpan</button>
          <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
        </div>
      </div>

    </div>
  </div>
<!-- End Modal -->
