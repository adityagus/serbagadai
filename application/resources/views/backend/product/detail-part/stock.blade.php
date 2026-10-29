<div class="portlet blue-madison box">
    <div class="portlet-title">
        <div class="caption">
            <span class="caption-subject bold uppercase">History Stock</span>
        </div>
    </div>

    <div class="portlet-body">
        <div class="row">
            <div class="col-md-12">
                <div class="portlet light bordered margin-top-20">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-share font-dark"></i> <span
                                    class="caption-subject font-dark bold uppercase">History Stock</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table id="myTable" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <td></td>
                                <td>
                                    <select class="form-control" name="s_types" onchange="filter()">
                                        <option value="">Pilih Tipe</option>
                                        @foreach(\App\Util\Constant::STOCK_TYPE_LIST as $value => $label)
                                            <option value="{{$value}}">{{$label}}</option>
                                        @endforeach
                                    </select>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr>
                                <th style="min-width: 100px;">Tanggal</th>
                                <th style="min-width: 100px;">Tipe</th>
                                <th style="min-width: 100px;">Order</th>
                                <th style="min-width: 100px;">Jumlah Sebelum</th>
                                <th style="min-width: 100px;">Jumlah Sesudah</th>
                            </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
