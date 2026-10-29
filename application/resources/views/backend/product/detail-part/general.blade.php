<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">Informasi Umum</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                @php
                    $i = 0;
                @endphp
                @foreach($model::FORM_FIELD as $keyField => $field)
                    @if($i%2==0)
                        <div class="row">
                            @endif
                            <div class="col-md-{{ $field=='texteditor'?'12':'6' }}">
                                <div class="form-group" id="{{$keyField}}">
                                    <label class="control-label {{ in_array($keyField, $model::FORM_VALIDATION_LIST) ? 'required-form' : '' }}">{{$model::FORM_LABEL[$keyField]}}</label>
                                    @if($field == 'text')
                                        <input type="{{$field}}" name="{{$keyField}}" class="form-control" value="{{@$model->$keyField}}" placeholder="{{$model::FORM_LABEL[$keyField]}}">
                                    @elseif($field=='number')
                                        <input type="text" name="{{$keyField}}" class="form-control autonumeric" maxlength="" value="{{@$model->$keyField}}" placeholder="{{$model::FORM_LABEL[$keyField]}}">
                                    @elseif($field=='date')
                                        <input type="text" name="{{$keyField}}" class="form-control datepickerinput" maxlength="" value="{{@$model->$keyField}}" placeholder="{{$model::FORM_LABEL[$keyField]}}">
                                    @elseif($field == 'image')
                                        <input type="file" name="{{$keyField}}" class="form-control" value="{{@$model->$keyField}}" {{!empty($model->id)?(in_array($keyField,$model::FORM_DISABLED)?'disabled':''):''}} placeholder="{{$model::FORM_LABEL[$keyField]}}">
                                        <br>
                                        @if(!empty(@$model->id))
                                            <a href="{{url('storage/'.@$model->$keyField)}}" target="_blank" title="preview"><img style="background-color: #e1e1e1" src="{{url('storage/'.@$model->$keyField)}}" width="100" height="100"></a>
                                        @endif
                                    @elseif($field == 'file')
                                        <input type="{{$field}}" name="{{$keyField}}" class="form-control" value="{{@$model->$keyField}}" placeholder="{{$model::FORM_LABEL[$keyField]}}">
                                        <br>
                                        @if(!empty(@$model->id))
                                            <a href="{{url('storage/'.@$model->$keyField)}}" target="_blank" title="preview">Lihat File</a>
                                        @endif
                                    @elseif($field == 'select')

                                        <select class="form-control" name="{{$keyField}}">
                                            @foreach(\App\Helpers\SelectHelper::getSelectList($model::FORM_SELECT_LIST[$keyField]) as $key => $val)
                                                <option value="{{ $key }}" {{ @$model->$keyField == $key ? 'selected' : '' }}>{{ $val }}</option>
                                            @endforeach
                                        </select>
                                    @elseif($field == 'texteditor')
                                        <textarea class="form-control summernote" id="{{$keyField}}" name="{{$keyField}}">{{@$model->$keyField}}</textarea>
                                    @else
                                        <textarea class="form-control" name="{{$keyField}}">{{@$model->$keyField}}</textarea>
                                    @endif
                                    <div class="help-block">{{ in_array($keyField,$model::FORM_HELP_LIST)? $model::FORM_LABEL_HELP[$keyField]:''}}</div>
                                    <div id="{{$keyField}}_error" class="help-block help-block-error"> </div>
                                </div>
                            </div>
                            @if(($i+1)%2==0)
                        </div>
                    @endif
                    @php
                        $i++;
                    @endphp
                @endforeach
            </div>
        </div>
    </div>
</div>
