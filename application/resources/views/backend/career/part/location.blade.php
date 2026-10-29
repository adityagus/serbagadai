<div class="row location_item">
    <div class="col-md-12">
        <h5><b>Lokasi Penempatan</b></h5>
        <div class="row">
            <div class="form-group">
                <div class="col-sm-6" id="text0">
                    <select type="text" class="form-control" name="location0" placeholder="Lokasi Penempatan">
                        <option value="">Pilih Lokasi </option>
                        @foreach($locations as $location)
                        <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                    <div id="location0_error" class="help-block help-block-error"> </div>
                </div>
                <div class="col-sm-1">
                    <button class="btn btn-sm btn-success" type="button" onclick="saveLocation(0)"><i class="fa fa-plus"></i> Tambah</button>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="form-group" id="locations">
                <div id="locations_error" class="help-block help-block-error"> </div>
            </div>
        </div>

        <table class="table table-striped table-bordered table-hover" style="margin-top: 20px">
            <thead>
            <tr>
                <th style="text-align: center">Lokasi</th>
                <th style="text-align: center;width: 100px;" >Aksi</th>
            </tr>
            </thead>
            <tbody id="list_location">
            <input type="hidden" name="locations" value="">

            <tr id="tr_sample">
                <td id="text_sample">
                    <select type="text" class="form-control" name="location" placeholder="Lokasi Penempatan">
                        <option value="">Pilih Lokasi </option>
                        @foreach($locations as $location)
                            <option value="{{ $location->id }}">{{ $location->name }}</option>
                        @endforeach
                    </select>
                    <div id="text_error" class="help-block help-block-error"> </div>
                </td>
                <td style="text-align: center">
                    <button class="btn btn-sm btn-danger btn-delete" onclick="saveLocation()"><i class="fa fa-remove"></i></button>
                </td>
            </tr>

            @foreach($career_location as $key => $value)
                <tr id="tr_{{$key+1}}">
                    <td id="location{{$key+1}}">
                        <select type="text" class="form-control" name="location{{$key+1}}" placeholder="Lokasi Penempatan">
                            <option value="">Pilih Lokasi </option>
                            @foreach($locations as $location)
                                <option value="{{ $location->id }}" {{ $location->id == $value->location_id ? 'selected' : '' }}>{{ $location->name }}</option>
                            @endforeach
                        </select>
                        <div id="location{{$key+1}}_error" class="help-block help-block-error"> </div>
                    </td>
                    <td style="text-align: center">
                        <button class="btn btn-sm btn-danger btn-delete" onclick="deleteLocation({{$key+1}})"><i class="fa fa-remove"></i></button>
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

        let career_location = [];
        @foreach(@$career_location as $location)
        career_location.push({
            'location':'{{ $location->location_id }}',
        })
        @endforeach

        let number = career_location.length;

        function saveLocation(id) {
            const fields = [
                'location',
            ];

            let data = {}
            fields.map(field=>{
                data[field] = $('.location_item [name='+field+id+']').val();
            });

            if(id == 0){
                career_location.push(data);

                number += 1;

                const item = $('.location_item #tr_sample').clone();
                item.show();
                item.prop('id','tr_'+number);
                item.find('.btn-delete').attr('onclick','deleteLocation('+number+')');
                fields.map(field=>{
                    item.find('#'+field+'_sample').prop('id',field+number);
                    item.find('[name='+field+']').prop('name',field+number).attr('onchange','saveLocation('+number+')').val($('[name='+field+'0]').val());
                    item.find('#'+field+'_error').prop('id','field'+number+'_error');
                    $('[name='+field+'0]').val('');
                })

                $('#list_location').append(item);

            }else{
                career_location[(id-1)] = data;
            }

            $('[name=locations]').val(JSON.stringify(career_location));
        }

        function deleteLocation(id) {
            $('#list_location #tr_'+id).remove();
            career_location.splice((id-1),1);
            $('[name=locations]').val(JSON.stringify(career_location));
        }
    </script>
@endpush