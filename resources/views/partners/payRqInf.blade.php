<div class="modal-content">
    <div class="panel panel-primary"><div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal_plansedit">
جزئیات درخواست واریز وجه

            </h4>
        </div>
        <div style="height: 400px; overflow: auto;" >
        <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
            <tr align="right">
                <td>مبلغ</td>
                <td>{{Jdate::echoNum($payrq->amount)}}</td>
            </tr>
            <tr align="right">
                <td>توضیحات</td>
                <td>{{$payrq->description}}</td>
            </tr>
            <tr align="right">
                <td>پاسخ درخواست</td>
                <td>@if($payrq->m_resp != ''){{$payrq->m_resp}}@else دردست بررسی @endif</td>
            </tr>
            <tr align="right">
                <td>تاریخ ثبت پاسخ</td>
                <td>@if($payrq->m_resp != ''){{Jdate::fn(Verta::instance($payrq->updated_at))}}@else دردست بررسی @endif</td>
            </tr>
        </table>
        </div>
    </div>

</div>