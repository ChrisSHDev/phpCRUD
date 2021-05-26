<h2>Users List</h2>

<table>
  <thead>
    <th>Name</th>
    <th>Email</th>
    <th>Edit</th>
  </thead>

  <tbody>
    <?php foreach ($authors as $author): ?>
    <tr>
      <td><?php echo $author -> name; ?></td>
      <td><?php echo $author -> email; ?></td>
      <td><a href="/author/permissions?id=<?php echo $author->id;?>">Edit Authority</a></td>
    </tr>
    <?php endforeach ?>
  </tbody>
</table>