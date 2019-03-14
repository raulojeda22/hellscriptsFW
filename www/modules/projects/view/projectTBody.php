<tr id="project<? echo $_POST['data']['id']; ?>">
    <td><h6><? echo $_POST['data']['id']; ?></h6></td>
    <td><h6><? echo $_POST['data']['name']; ?></h6></td>
    <td><h6><? echo $_POST['data']['description']; ?></h6></td>
    <td><h6><? echo $_POST['data']['website']; ?></h6></td>
    <td><h6><? echo $_POST['data']['license']; ?></h6></td>
    <td><h6><? echo $_POST['data']['privacy']; ?></h6></td>
    <td><h6><? echo $_POST['data']['languages']; ?></h6></td>
    <td><button class="btn btn-primary btn-sm projectGet" name="GET">Get</button></td>
    <td><button class="btn btn-primary btn-sm projectUpdate" name="PUT">Update</button></td>
    <td><button class="btn btn-primary btn-sm projectDelete" name="DELETE">Delete</td>
</tr>