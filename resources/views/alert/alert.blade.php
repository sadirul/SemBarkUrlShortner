<style>
    .alert-box {
        padding: 12px 16px;
        border-radius: 6px;
        margin: 10px 0;
        font-family: sans-serif;
        display: flex;
        align-items: center;
        gap: 10px;
        position: relative;
    }

    .alert-box.success {
        background: #e8f9ee;
        color: #2b7a4b;
        border-left: 4px solid #2b7a4b;
    }

    .alert-box.error {
        background: #fdeaea;
        color: #c0392b;
        border-left: 4px solid #c0392b;
    }

    .alert-box .icon {
        font-size: 20px;
    }

    .alert-box ul {
        margin: 0;
        padding-left: 20px;
    }

    .close-btn {
        position: absolute;
        right: 12px;
        top: 8px;
        font-size: 22px;
        cursor: pointer;
    }
</style>
@if (session('success'))
    <div class="alert-box success">
        <span class="icon">&#10004;</span>
        <span><strong>Success!</strong> {{ session('success') }}</span>
        <span class="close-btn" onclick="this.parentElement.style.display='none'">&times;</span>
    </div>
@endif

@if (session('error'))
    <div class="alert-box error">
        <span class="icon">&#10006;</span>
        <span>{{ session('error') }}</span>
        <span class="close-btn" onclick="this.parentElement.style.display='none'">&times;</span>
    </div>
@endif
