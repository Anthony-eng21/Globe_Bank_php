<?php 
  /*
  There's no id for our homepage [undefined] so we set a default net for it
  this happens when we try to add the $page_id and $subject_id vars in our while
  loop default here will be an empty string
  */
  $page_id = $page_id ?? ''; //default null coleasc
  $subject_id = $subject_id ?? '';
  $visible = $visible ?? true; //master var in some associatve arr used globally

  ?>

<navigation>
  <?php $nav_subjects = find_all_subjects(['visible' => $visible]); //use that that param we set up here as an arg for visible being $visible ?>
  <ul class="subjects">
    <!-- loop for our subjects be weary of the nested loop lol -->
    <?php while ($nav_subject = mysqli_fetch_assoc($nav_subjects)) { ?>
      <?php //if(!$nav_subject['visible']) { continue; } ?> <!-- conditional compares against a boolean field in our $nav_subject value -->
      <li class="<?php if($nav_subject['id'] === $subject_id) { echo 'selected'; } ?>">
        <a href="<?php echo url_for('index.php?subject_id=' . h(u($nav_subject['id']))); ?>">
          <?php echo h($nav_subject['menu_name']); ?>
        </a>

        <?php if($nav_subject['id'] == $subject_id) { ?>
        <!-- loop for our pages in our subject loop   -->
        <?php $nav_pages = find_pages_by_subject_id($nav_subject['id'], ['visible' => $visible]); ?>
        <ul class="pages">
          <?php while ($nav_page = mysqli_fetch_assoc($nav_pages)) { ?>
            
            <?php // if(!$nav_page['visible']) { continue; } ?> <!-- TODO --><!-- conditional compares against a boolean field in our $nav_subject value -->
            <!-- compare the created $page_id in our url against the id of the $nav_page's id in it's arr while it's looping through these -->
            <li class="<?php if($nav_page['id'] === $page_id) { echo 'selected'; } ?>">
              <!-- secure url TO the page of each of our urls for each nav link  -->
              <a href="<?php echo url_for('index.php?id=' . h(u($nav_page['id']))); ?>">
                <?php echo h($nav_page['menu_name']); ?>
              </a>

            </li>
          <?php } // while $nav_pages 
          ?>
        </ul>
        <?php mysqli_free_result($nav_pages); ?>
        <!-- -->
        <?php } // if $nav_subject['id'] == $subject_id?>

      </li>
    <?php } // while $nav_subjects 
    ?>
  </ul>
  <?php mysqli_free_result($nav_subjects); ?>
</navigation>