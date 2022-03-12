<div class="search-order">
    <form autocomplete="off" action="return:javascript:;">
        <div class="row">
            <div class="col-md-5 col-sm-12 col-xs-12">
                <input id="txt_searching" type="text" name="" placeholder="Tìm kiếm theo UserName" class="hasDatepicker">
                <i class="fa fa-search" aria-hidden="true"></i>
            </div>
            <div class="col-md-2 col-sm-6 col-xs-3 pull-right">
                <span id="btn_sync_client" class="add_real code_real">Đồng bộ tài khoản <img src="{$domain}/public/images/sync.png" width="24"></span>
            </div>
        </div>
    </form>
</div>

<div class="content-pr bg-white">

    <div class="wrap-table-detail">
        <div class="table-responsive table-detail table-0-15">
            <table class="table table-bg-no">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Họ & tên</th>
                        <th>Email</th>
                        <th>Điện thoại</th>
                        <th>VND</th>
                        <th>VNDC</th>
                        <th>BRS</th>
                        <th>VSG</th>
                        <th>Trạng thái</th>
                    </tr>
                </thead>
                <tbody id="tpl_list">
                    
                </tbody>
            </table>
            <div id="hd_page_html" class="col-lg-12 col-md-12 top10">
                <div id="page_html" class="col-lg-12 col-md-12 top10">
                </div>
            </div>
        </div>

        <div class="infomation_table infomation_investor">
            <i class="fa fa-angle-left" aria-hidden="true"></i>

            <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-12 pull-right">
                    <label class="label_name">BRS</label>
                    <div class="input_name">
                        <input hidden id="id" type="text" name="id" value="">
                        <input disabled id="d_brs" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 pull-right">
                    <label class="label_name">VSG</label>
                    <div class="input_name">
                        <input hidden id="id" type="text" name="id" value="">
                        <input disabled id="d_vsg" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-xs-12 pull-right">
                    <label class="label_name">VNDC</label>
                    <div class="input_name">
                        <input hidden id="id" type="text" name="id" value="">
                        <input disabled id="d_vndc" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                 <div class="col-md-3 col-sm-6 col-xs-12 pull-right">
                    <label class="label_name">VND</label>
                    <div class="input_name">
                        <input hidden id="id" type="text" name="id" value="">
                        <input disabled id="d_vnd" class="form-control" type="text" name="" value="">
                    </div>
                </div>
                
            </div>

        <div class="tab-content">              
        
            <ul class="nav nav-tabs nav-storing storing4">

                <li id="tab_vnd" class="active"><a data-toggle="tab" href="#vnd">Giao dịch VND</a></li>
                <li id="tab_vndc"><a data-toggle="tab" href="#vndc">Giao dịch VNDC</a></li>
                <li id="tab_brs"><a data-toggle="tab" href="#brs">Giao dịch BRS</a></li>
                <li id="tab_vsg"><a data-toggle="tab" href="#vsg">Giao dịch VSG</a></li>
        
            </ul>

            <div id="vnd" class="tab-pane active fade in">
                <div class="table-responsive">
                    <table class="table table-bg-no">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Họ tên</th>
                                <th>Nội dung</th>
                                <th>Số điểm</th>
                                <th>Ngày giao dịch</th>
                            </tr>
                        </thead>
                        <tbody id="tpl_vnd">
                        </tbody>
                    </table>
                    
                </div>
            </div>

            <div id="vndc" class="tab-pane fade">
                <div class="table-responsive">
                    <table class="table table-bg-no">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Họ tên</th>
                                <th>Nội dung</th>
                                <th>Số điểm</th>
                                <th>Ngày giao dịch</th>
                            </tr>
                        </thead>
                        <tbody id="tpl_vndc">
                        </tbody>
                    </table>
                    <div class="col-lg-12 col-md-12 top10">
                        <div id="page_html_dgh" class="col-lg-12 col-md-12 top10">
                        </div>
                        <input class="hide" type="text" id="current_page_dgh">
                    </div>
                </div>
            </div>

            <div id="brs" class="tab-pane fade in">
                <div class="table-responsive">
                    <table class="table table-bg-no">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Họ tên</th>
                                <th>Nội dung</th>
                                <th>Số điểm</th>
                                <th>Ngày giao dịch</th>
                            </tr>
                        </thead>
                        <tbody id="tpl_brs">
                        </tbody>
                    </table>
                    <div class="col-lg-12 col-md-12 top10">
                        <div id="page_html_dss" class="col-lg-12 col-md-12 top10">
                        </div>
                        <input class="hide" type="text" id="current_page_dss">
                    </div>
                </div>
            </div>

            <div id="vsg" class="tab-pane fade in">
                <div class="table-responsive">
                    <table class="table table-bg-no">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>UserName</th>
                                <th>Họ tên</th>
                                <th>Nội dung</th>
                                <th>Số điểm</th>
                                <th>Ngày giao dịch</th>
                            </tr>
                        </thead>
                        <tbody id="tpl_vsg">
                        </tbody>
                    </table>
                    <div class="col-lg-12 col-md-12 top10">
                        <div id="page_html_dss" class="col-lg-12 col-md-12 top10">
                        </div>
                        <input class="hide" type="text" id="current_page_dss">
                    </div>
                </div>
            </div>

        </div>
     </div>
        
</div>

    

</div>