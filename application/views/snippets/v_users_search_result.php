<?php if ($records != null && $records != -1): ?>
  <table >
    <thead>
      <tr>
        <th>ID</th>
        <th>Användarnamn</th>
        <th>E-postadress</th>
        <th>Namn</th>
        <th>Skapad</th>
        <th>Profil</th>
        <th>Aktiverad</th>
        <th>Redigera</th>
      </tr>
    </thead>
    <tbody>

    <?php
    foreach ($records as $row):
      $bold_word = '<b>' . $search_word . '</b>';
      $formatId = str_ireplace($search_word, $bold_word, $row->id);
      $formatNick = str_ireplace($search_word, $bold_word, $row->nick);
      $formatEmail = str_ireplace($search_word, $bold_word, $row->email);
      $formatName = str_ireplace($search_word, $bold_word, $row->f_name . ' ' . $row->l_name);
    ?>
      <tr>
        <td> <?php echo $formatId; ?></td>
        <td> <?php echo $formatNick; ?> </td>
        <td> <?php echo $formatEmail; ?></td>
        <td> <?php echo $formatName; ?> </td>
        <td> <?php echo $row->created_at; ?></td>
        <td> <a style="text-decoration: underline; color: blue;" href="/pages/profil.php?mid=23332">Simulera</a> </td>
        <td class="mmList1 mmRed"> </td>
        <td> <a style="text-decoration: underline; color: blue;" href="/admin/pages/medlem.php?id=23332">Redigera</a> </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
<?php else: ?>
  <p>No Results found</p>
<?php endif; ?>
