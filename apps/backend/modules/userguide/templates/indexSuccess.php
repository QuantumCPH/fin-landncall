<h1><?php echo  __('Userguide List') ?></h1>

<table>
  <thead>
    <tr>
      <th><?php echo  __('Id') ?></th>
      <th><?php echo  __('Title') ?></th>
      <th><?php echo  __('Description') ?></th>
      <th><?php echo  __('Country') ?></th>
      <th><?php echo  __('Status') ?></th>
      <th><?php echo  __('Image') ?></th>
      <th><?php echo  __('Create at') ?></th>
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
