<tr id="project<? echo $_POST['data']['id']; ?>">
    <td><img src="<? echo $_POST['data']['image']; ?>" height="125px" width="125px"></td>
    <td><h1><? echo $_POST['data']['id']; ?></h1></td>
    <td><h1><? echo $_POST['data']['name']; ?></h1></td>
    <td><h1 id="price<? echo $_POST['data']['id']; ?>"><? echo $_POST['data']['price']; ?></h1></td>
    <td><button class="btn btn-primary btn-sm cartDelete" data-id="<? echo $_POST['data']['id']; ?>" name="DELETE"><i class="icon-minus"></i></td>
    <td><h1 id="count<? echo $_POST['data']['id']; ?>"><? echo $_POST['count']; ?></h1></td>
    <td><button class="btn btn-primary btn-sm cartPost" data-id="<? echo $_POST['data']['id']; ?>" name="POST"><i class="icon-plus"></i></button></td>
    <td><h1 class="projectPrice" id="totalPrice<? echo $_POST['data']['id']; ?>"></h1></td>
    <td><button class="btn btn-primary btn-sm projectDelete" data-id="<? echo $_POST['data']['id']; ?>" name="DELETE"><i class="icon-cross"></i></button></td>
</tr>