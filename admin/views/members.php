<h1 class="mb-4">Quản lý Thành viên</h1>
<form method="POST">
    <input type="hidden" name="member_id" value="0">
    <div class="mb-3">
        <label for="member_name" class="form-label">Tên thành viên</label>
        <input type="text" class="form-control" id="member_name" name="member_name" required>
    </div>
    <div class="mb-3">
        <label for="member_role" class="form-label">Vai trò</label>
        <input type="text" class="form-control" id="member_role" name="member_role" required>
    </div>
    <button type="submit" name="update_member" class="btn btn-primary">Thêm/Cập nhật thành viên</button>
</form>
<div class="mt-4">
    <h2>Danh sách thành viên</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên</th>
                <th>Vai trò</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $members = get_members($conn);
            while ($member = mysqli_fetch_assoc($members)) : ?>
                <tr>
                    <td><?php echo $member['name']; ?></td>
                    <td><?php echo $member['role']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editMember(<?php echo $member['id']; ?>, '<?php echo $member['name']; ?>', '<?php echo $member['role']; ?>')">Sửa</button>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="member_id" value="<?php echo $member['id']; ?>">
                            <button type="submit" name="delete_member" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editMember(id, name, role) {
    document.querySelector('input[name="member_id"]').value = id;
    document.querySelector('input[name="member_name"]').value = name;
    document.querySelector('input[name="member_role"]').value = role;
}
</script>

