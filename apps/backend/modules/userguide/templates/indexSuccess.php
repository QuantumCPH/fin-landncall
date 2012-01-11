<h1>Userguide List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Description</th>
      <th>Country</th>
      <th>Status</th>
      <th>Image</th>
      <th>Create at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($userguide_list as $userguide): ?>
    <tr>
      <td><a href="<?php echo url_for('userguide/edit?id='.$userguide->getId()) ?>"><?php echo $userguide->getId() ?></a></td>
      <td><?php echo $userguide->getTitle() ?></td>
      <td><?php echo $userguide->getDescription() ?></td>
      <td><?php echo $userguide->getCountryId() ?></td>
      <td><?php echo $userguide->getStatusId() ?></td>
      <td><?php echo $userguide->getImage() ?></td>
      <td><?php echo $userguide->getCreateAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('userguide/new') ?>">New</a>
