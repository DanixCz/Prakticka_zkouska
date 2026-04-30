document.addEventListener('DOMContentLoaded', function () {
    const resetBtn = document.getElementById('resetBtn');
    const form = document.getElementById('mainForm');

    if (!resetBtn || !form) {
        return;
    }

    resetBtn.addEventListener('click', function () {
        form.reset();
    });
});
