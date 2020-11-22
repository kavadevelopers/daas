<!DOCTYPE html>
<html>
    <head>
        
    </head>
    <body>
        <br><br>
        <table style="width:100%">
            <tr>
                <td style="font-size: 25px; text-align: center; font-weight: bold; color: #6e6e6e;">
                   EXPENSES REIMBURSMENT MEMO
                </td>
            </tr>
        </table>
        <br><br>
        <table style="width:100%">
            <tr>
                <td style="font-size: 25px;">
                    
                </td>
                <td align="right">
                    <table  style="width:100%">
                        <tr>
                            <td align="right"><b>Reimbursment</b> : #<?= $invoice['invoice'] ?> </td>
                        </tr>
                        <tr>
                            <td align="right"><b>Client</b> : #<?= $this->general_model->_get_client($invoice['client'])['c_id'] ?> </td>
                        </tr>
                        <tr>
                            <td align="right"><b>Date</b> : <?= vd($invoice['date']) ?> </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br><br>
        <?php $client = $this->general_model->_get_client($invoice['client']); ?>
        <table style="width:100%">
            <tr>
                <th>
                   <b>To :  </b>
                </th>
            </tr>
            <tr>
                <td align="left">
                    <table style="width: 50%">
                        <tr>
                            <td align="left"><?= $client['fname'].' '.$client['mname'].' '.$client['lname'] ?> <?= $client['firm'] != ""?' ('.$client['firm'].')':'' ?></td>
                        </tr>
                        <tr>
                            <td align="left" style="font-size: 10px;"><?= $client['add1'] ?></td>
                        </tr>
                        <?php if($client['add2'] != ""){ ?>
                            <tr>
                                <td align="left" style="font-size: 10px;"><?= $client['add2'] ?></td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td align="left" style="font-size: 10px;"><?=  $this->general_model->_get_area($client['area'])['name'] ?>, <?= $this->general_model->_get_city($client['city'])['name'] ?>, <?= $this->general_model->_get_district($client['district'])['name'] ?>, <?= $this->general_model->_get_state($client['state'])['name'] ?> <?= $client['pin'] != ''?",".$client['pin']:''; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

        <br><br>
        
        <table style="width: 100%; background-color: #6e6e6e; color: #fff; border-bottom: 1px solid #ddd;" cellpadding="5px;">
            <tr>
                <td style="width: 15%; text-align: center;"><b>SN</b></td>
                <td style="width: 60%;"><b>Particulars</b></td>
                <td style="width: 25%; text-align: right;"><b>Total</b></td>
            </tr>
        </table>

        <table style="width: 100%; border-bottom: 1px solid #ddd;" cellpadding="5px;">
            <tr>
                <td style="width: 15%; text-align: center;">1</td>
                <td style="width: 60%;"><?= $invoice['particular'] ?></td>
                <td style="width: 25%; text-align: right;"><?= $invoice['amount'] ?></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
        
        <table style="width: 100%; background-color: #6e6e6e; color: #fff; border-bottom: 1px solid #ddd;" cellpadding="5px;">
            <tr>
                <td style="width: 15%; text-align: center;"></td>
                <td style="width: 60%; text-align: right;">Total : </td>
                <td style="width: 25%; text-align: right;"><b>Rs. <?= $invoice['amount'] ?></b></td>
            </tr>
        </table>
  

        <br><br>

        <table style="width: 100%">
            <tr>
                <td>This expenses paid on behalf of you so kindly reimbus the same</td>
                <td style="text-align: right;">
                    <b>For, <?= $this->general_model->_get_company($invoice['company'])['name'] ?></b>
                </td>
            </tr>
        </table>

        <br><br>
        <table style="width: 100%">
            <tr>
                <td align="center" style="font-style: italic; font-size: 10px; ">This is computer generated invoice doesn't required signature</td>
            </tr>
        </table>
    </body>
</html>