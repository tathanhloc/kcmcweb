<h1 class="mb-4">Quản lý Dự án</h1>
<form method="POST">
    <input type="hidden" name="project_id" value="0">
    <div class="mb-3">
        <label for="project_name" class="form-label">Tên dự án</label>
        <input type="text" class="form-control" id="project_name" name="project_name" required>
    </div>
    <div class="mb-3">
        <label for="project_status" class="form-label">Trạng thái</label>
        <select class="form-control" id="project_status" name="project_status" required>
            <option value="Hoàn thành">Hoàn thành</option>
            <option value="Đang tiến hành">Đang tiến hành</option>
            <option value="Sắp triển khai">Sắp triển khai</option>
        </select>
    </div>
    <div class="mb-3">
        <label for="project_description" class="form-label">Mô tả</label>
        <textarea class="form-control" id="project_description" name="project_description" rows="3" required></textarea>
    </div>
    <button type="submit" name="update_project" class="btn btn-primary">Thêm/Cập nhật dự án</button>
</form>
<div class="mt-4">
    <h2>Danh sách dự án</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Tên dự án</th>
                <th>Trạng thái</th>
                <th>Mô tả</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $projects = get_projects($conn);
            while ($project = mysqli_fetch_assoc($projects)) : ?>
                <tr>
                    <td><?php echo $project['name']; ?></td>
                    <td><?php echo $project['status']; ?></td>
                    <td><?php echo $project['description']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editProject(<?php echo $project['id']; ?>, '<?php echo $project['name']; ?>', '<?php echo $project['status']; ?>', '<?php echo addslashes($project['description']); ?>')">Sửa</button>
                        <form method="POST" class="d-inline">
                            <input type="hidden" name="project_id" value="<?php echo $project['id']; ?>">
                            <button type="submit" name="delete_project" class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editProject(id, name, status, description) {
    document.querySelector('input[name="project_id"]').value = id;
    document.querySelector('input[name="project_name"]').value = name;
    document.querySelector('select[name="project_status"]').value = status;
    document.querySelector('textarea[name="project_description"]').value = description;
}
</script>

