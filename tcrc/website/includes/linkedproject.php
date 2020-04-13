<div id="student" class="col-6">
  <div class="card">
    <div class="card-header">
      <h3 class="card-title">Linked Projects(<?php if(is_a($tableProject,"mysqli_result")) echo $counter?> results)</h3>
    </div>
  </div>
  <div class="card-body">
  <table class="table">
    <thead>
      <tr>
        <th>id</th>
        <th>Project Title</th>
        <th>Project Number</th>
        <th>Staff Code</th>
        <th>Project Status</th>
      </tr>
    </thead>
    <tbody>
      <?php for ($i=0; $i < count($projectArray); $i++) {
        // code...
        echo "<tr>";
          echo "<td><a href='projectprofile.php?id={$projectArray[$i]['0']}' style='color:red'>{$projectArray[$i]['0']}</a></td>";
          echo "<td>{$projectArray[$i]['1']}</td>";
          echo "<td>{$projectArray[$i]['2']}</td>";
          echo "<td>{$projectArray[$i]['3']}</td>";
          echo "<td>{$projectArray[$i]['4']}</td>";
          echo "</tr>";
       }?>
    </tbody>
  </table>
</div>
</div>
