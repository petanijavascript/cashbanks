 
<html>
    <style>
        
        .img{
            padding:20px;
            text-align: center;
            background:#2c3e50;
        }
        table{
            border-spacing: 30px;
            border-collapse: collapse;
            font-size:14px;
        }
        table thead th:first-child{ text-align: center; }
        table thead th{ text-align: center; padding-left: 20px;background: #2c3e50;color:white;}
        table tr td:first-child { text-align: left; }
        table tr td{  
            padding-left: 30px;
            padding-bottom: 2px;
            text-align: right; 
            line-height: 20px; 
            min-width: 130px;
            white-space: nowrap;
        }
        table tfooter tr td{
            font-weight: bold;
        } 
        .green{
            width: 100px;
            height: 20px;
            background:#44bd32;color:white;
        }
        .yellow{
            width: 100px;
            height: 20px;
            background:yellow;color:black;
        }
        .red{
            width: 100px;
            height: 20px;
            background:red;color:white;
        }
    </style>
    
    <body>
        
    <div class="img">
        <img src="http://cashbank.ciputragroup.com/cashbank/public/global/img/logo-header.png" alt="logo" height="100px"/>
    </div>
    <p>Dear Bapak/Ibu,</p><p></p><p></p><p></p> 
    <p>Berikut record pengiriman laporan cashbank pada:</p> 
    <p>Project/PT: {{$projectName}}  {{$ptName}}</p>  

        @foreach($listUser as $user)  
        
                <?php 
                    $username   = $user->email;
                    $listYear   = array();
                    $listMonth  = array();
                    $listWeek   = array();
                    $listDate   = array();
                    $dateBegin  = date("Y").'-'.date("M").'-01';
                    $dateEnd    = date("Y").'-'.date("M").'-' . date('t', strtotime($dateBegin)); //get end date of month
                    $monthsTemp = date('m', strtotime($dateBegin));
                    $weeks      = 0;
                ?>

                User :{{$user->email}}</br>  
                <table border="1px">
                        <thead> 
                            <th>Lap Tahun</th>
                            <th>Bulan</th>
                            <th>Minggu</th>
                            <th>Target</th>
                            <th>Dikirim</th>
                            <th>Selisih</th> 
                        </thead>
                        <tbody>
                    <?php
                        while(strtotime($dateBegin) <= strtotime($dateEnd)) {
                            $dates      = date('Y-m-d', strtotime($dateBegin));
                            $months     = date('m', strtotime($dateBegin));
                            $monthName  = date('F', strtotime($dateBegin));
                            $years      = date('Y', strtotime($dateBegin));
                            $day_num    = date('d', strtotime($dateBegin));
                            $day_name   = date('l', strtotime($dateBegin));
                            $dateBegin  = date("Y-m-d", strtotime("+1 day", strtotime($dateBegin)));
                            if($day_name=="Monday"){
                                array_push($listDate, $dates);
                                if($months != $monthsTemp){
                                    $weeks=1;
                                    $monthsTemp=$months;
                                }else{
                                    $weeks+=1;
                                }

                                $invoice = DB::table('log_transaction AS log') 
                                            ->select([
                                                DB::raw('report_send_date')  
                                            ])->whereRaw(
                                                'report_year = '.$years." and 
                                                report_month =  ".$months." and 
                                                report_week = ".$weeks.' and 
                                                username="'.$username.'" and
                                                project_id= '.$projectID.' and 
                                                detail LIKE \'%nanik@ciputra.com%\' '
                                                )->groupBy('report_year','report_month','report_week')->get(); 
                                if(count($invoice)>0){
                                    if($invoice[0]->report_send_date){
                                        echo("<tr>"); 
                                        echo("<td>".$years."</td>");
                                        echo("<td>".$monthName."</td>");
                                        echo("<td>".$weeks."</td>");
                                        $date=date_create($dates);
                                        echo("<td>".date_format($date,"Y/m/d l")."</td>");
                                        $date=date_create($invoice[0]->report_send_date);
                                        echo("<td>".date_format($date,"Y/m/d l")."</td>");
                                        $date1=date_create($dates);
                                        $date2=date_create($invoice[0]->report_send_date);
                                        $diff=date_diff($date1,$date2);
                                        $diffNumber=$diff->format("%a");
                                        $diffRange=$diff->format("%R"); 
                                        $style=""; 
                                        if($diffNumber<=3){
                                            $style="background:#44bd32;color:white;";
                                        }else if($diffNumber==4||$diffNumber==5){
                                            $style="background:yellow;color:black;";
                                        }else if($diffNumber>5){
                                            $style="background:red;color:white;";
                                        }
                                        echo $diff->format("<td style=\"".$style."\"> %R%a Hari </td>"); 
                                        echo "</tr>";
                                    }
                                } else{
                                    echo("<tr>"); 
                                    echo("<td>".$years."</td>");
                                    echo("<td>".$monthName."</td>");
                                    echo("<td>".$weeks."</td>");
                                    $date=date_create($dates);
                                    echo("<td>".date_format($date,"Y/m/d l")."</td>"); 
                                    echo("<td colspan=\"2\" style=\"background:red;color:white;\">Tidak ada pengiriman laporan.</td>");
                                    echo("</tr>");
                                }

 
                                array_push($listWeek, $weeks);
                                array_push($listMonth, $months);
                                array_push($listYear, $years);
                            } 
                        } 
                    ?>
                    </tbody> 
                </table> 

            @endforeach
        
                             

            <p>
                *Keterangan:
                <table>
                    <tr><td><div class="green"></div></td><td>Tepat Waktu</td></tr> 
                    <tr><td><div class="yellow"></div></td><td>Terlambat lebih dari 3 hari</td></tr> 
                    <tr><td><div class="red"></div></td><td>Terlambat lebih dari 6 hari</td></tr> 
                </table>
            </p>
    
    </body>
</html> 