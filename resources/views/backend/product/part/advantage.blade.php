<div class="row advantage_item">
    <div class="col-md-12">
        <h5><b>Keunggulan</b></h5>
        <div class="row">
            <div class="form-group">
                <div class="col-sm-6" id="text0">
                    <textarea type="text" class="form-control" name="text0" rows="5" placeholder="Keunggulan"></textarea>
                    <div id="text0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1" id="priority0">
                    <input type="number" class="form-control" name="priority0" min="2" placeholder="Priority">
                    <div id="priority0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-sm btn-success" type="button" onclick="saveAdvantage(0)"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" id="advantages">
                <div id="advantages_error" class="help-block help-block-error"> </div>
            </div>
        </div>

        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
            <thead>
            <tr>
                <th style="text-align: center">Keunggulan</th>
                <th style="text-align: center">Priority</th>
                <th style="text-align: center;width: 100px;" >Aksi</th>
            </tr>
            </thead>
            <tbody id="list_advantage">
            <input type="hidden" name="advantages" value="">

            <tr id="tr_sample">
                <td id="text_sample">
                    <textarea type="text" class="form-control" name="text" rows="5" placeholder="Keunggulan"></textarea>
                    <div id="text_error" class="help-block help-block-error"> </div>
                </td>
                <td id="priority_sample">
                    <input type="number" name="priority" class="form-control">
                    <div id="priority_error" class="help-block help-block-error"> </div>
                </td>
                <td style="text-align: center">
                    <button class="btn btn-sm btn-danger btn-delete" onclick="deleteAdvantage()"><i class="fa fa-remove"></i></button>
                </td>
            </tr>

            @foreach($advantages as $key => $value)
                <tr id="tr_{{$key+1}}">
                    <td id="text{{$key+1}}">
                        <textarea type="text" class="form-control" name="text{{$key+1}}" rows="5" placeholder="Keunggulan">{{@$value->text}}</textarea>
                        <div id="text{{$key+1}}_error" class="help-block help-block-error"> </div>
                    </td>
                    <td id="priority{{$key+1}}">
                        <input type="number" name="priority{{$key+1}}" class="form-control" value="{{@$value->priority}}" placeholder="Prioritas Keunggulan ke-{{$key+1}}">
                        <div id="priority{{$key+1}}_error" class="help-block help-block-error"> </div>
                    </td>
                    <td style="text-align: center">
                        <button class="btn btn-sm btn-danger btn-delete" onclick="deleteAdvantage({{$key+1}})"><i class="fa fa-remove"></i></button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@push('customJs')
    <script type="text/javascript">

        $('#tr_sample').hide();

        let advantages = [];
        @foreach(@$advantages as $advantage)
        advantages.push({
            'text':'{{ $advantage->text }}',
            'priority':'{{ $advantage->priority }}',
        })
        @endforeach

        $('[name=advantages]').val(JSON.stringify(advantages));

        let number = advantages.length;

        function saveAdvantage(id) {
            const fields = [
                'text',
                'priority'
            ];

            let data = {}
            fields.map(field=>{
                data[field] = $('.advantage_item [name='+field+id+']').val();
            });

            if(id == 0){
                advantages.push(data);

                number += 1;

                const item = $('.advantage_item #tr_sample').clone();
                item.show();
                item.prop('id','tr_'+number);
                item.find('.btn-delete').attr('onclick','deleteAdvantage('+number+')');
                fields.map(field=>{
                    item.find('#'+field+'_sample').prop('id',field+number);
                    item.find('[name='+field+']').prop('name',field+number).attr('onchange','saveAdvantage('+number+')').val($('[name='+field+'0]').val());
                    item.find('#'+field+'_error').prop('id','field'+number+'_error');
                    $('[name='+field+'0]').val('');
                })

                $('#list_advantage').append(item);

            }else{
                advantages[(id-1)] = data;
            }

            $('[name=advantages]').val(JSON.stringify(advantages));
        }

        function deleteAdvantage(id) {
            $('#list_advantage #tr_'+id).remove();
            advantages.splice((id-1),1);
            $('[name=advantages]').val(JSON.stringify(advantages));
        }
    </script>
@endpush