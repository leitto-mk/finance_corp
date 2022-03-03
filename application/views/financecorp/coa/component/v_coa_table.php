<thead>
    <tr>
      <th class="text-center bold bg-default" width="5%">Account</th>
      <th class="text-center bold bg-default" width="85%" colspan="4">Description</th>
      <th class="text-center bold bg-default" width="5%">Type</th>
      <th class="text-center bold bg-default" width="5%">Group</th>
      
    </tr>
  </thead>
<tbody>
  <?php foreach ($coa as $row => $value) : ?>
    <tr class="bg-blue-chambray font-white" data-unique="<?= $value['ID'] ?>" style="cursor:pointer">
      <td width="1%" align="center"><?= $value['Acc_No'] ?></td>
      <td colspan="4"><?= $value['Acc_Name'] ?></td>
      <td width="1%" class="bold text-center"><?= $value['Acc_Type'] ?></td>
      <td class="bold text-center"><?= $value['TransGroup'] ?></td>
    </tr>
    <?php if (isset($value['child'])) : ?>
      <?php foreach ($value['child'] as $row => $value) : ?>
        <tr class="bg-green font-white" data-unique="<?= $value['ID'] ?>" style="cursor:pointer">
          <td class="bg-white"></td>
          <td width="1%" align="center"><?= $value['Acc_No'] ?></td>
          <td colspan="3"><?= $value['Acc_Name'] ?></td>
          <td class="bold text-center"><?= $value['Acc_Type'] ?></td>
          <td class="bold text-center"><?= $value['TransGroup'] ?></td>
        </tr>
        <?php if (isset($value['child'])) : ?>
          <?php foreach ($value['child'] as $row => $value) : ?>
            <tr class="bg-blue-madison font-white" data-unique="<?= $value['ID'] ?>" style="cursor:pointer">
              <td class="bg-white" colspan="2"></td>
              <td width="1%" align="center"><?= $value['Acc_No'] ?></td>
              <td colspan="2"><?= $value['Acc_Name'] ?></td>
              <td class="bold text-center"><?= $value['Acc_Type'] ?></td>
              <td class="bold text-center"><?= $value['TransGroup'] ?></td>
            </tr>
            <?php if (isset($value['child'])) : ?>
              <?php foreach ($value['child'] as $row => $value) : ?>
                <tr class="bg-white font-dark bold" data-unique="<?= $value['ID'] ?>" style="cursor:pointer">
                  <td class="bg-white" colspan="3"></td>
                  <td width="1%" align="center"><?= $value['Acc_No'] ?></td>
                  <td><?= $value['Acc_Name'] ?></td>
                  <td class="bold text-center"><?= $value['Acc_Type'] ?></td>
                  <td class="bold text-center"><?= $value['TransGroup'] ?></td>
                </tr>
              <?php endforeach; ?>
            <?php endif; ?>
          <?php endforeach; ?>
        <?php endif; ?>
      <?php endforeach; ?>
    <?php endif; ?>
  <?php endforeach; ?>
</tbody>