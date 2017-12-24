<div class="modal-content">
    <div class="panel panel-primary"><div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modal_plansedit">
               لیست بازدیدها :  {{ Jdate::fn(count($visits))}} مورد

            </h4>
        </div>
        <div style="height: 400px; overflow: auto;" >
        <table align="center"  dir="rtl" class="table  table-striped table-condensed  table-hover">
            <tr align="center">
                <td width="10px">ردیف</td>
                <td>زمان</td>
            </tr>
            <?php $i=0;?>
            @foreach ($visits as $visit )
                <?php $i++;?>
                <tr align="center">
                    <td >{{ Jdate::fn($i)}}</td>
                    <td >{{Jdate::fn(Verta::instance($visit->created_at))}}</td>
                </tr>
            @endforeach
        </table>
        </div>
    </div>

</div>