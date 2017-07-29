<?php
/**
 * Created by IntelliJ IDEA.
 * User: henry
 * Date: 29.07.17
 * Time: 16:53
 */


?>

<style>

    table th {
        text-align: left;
        padding: 10px;
    }

    table tr:nth-child(even) {
        background: #CCC
    }

    table tr:nth-child(odd) {
        background: #FFF
    }

    table td {
        padding: 10px;
    }
</style>
<h1>ACO Donation Settings</h1>
<form method="post" onsubmit="<?php saveProject() ?>">
    <?php
    $projects = array();
    ?>
    <label>Add Project:</label>
    <input type="text" name="project">
    <input type="submit" value="Save" onClick="window.location.reload()">
</form>


<form method="post" onsubmit="<?php deleteProject()?>">
    <label>Delete Project:</label>
    <select name="deleteProject">
        <?php
        $options = get_option('aco_donation_options');
        foreach ($options['projects'] as $project){
            echo "<option value='".$project."'>".$project."</option>";

        }
        ?>
    </select>
    <input type="submit" value="Delete">

</form>

<table>
    <th>Projekte</th>
    <?php
    $options = get_option('aco_donation_options');
    foreach ($options['projects'] as $project){
        echo "<tr><td>".$project."</td></tr>";

    }
    ?>
</table>



