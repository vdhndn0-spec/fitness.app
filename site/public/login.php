<?php
/**
 * User Login Page
 */
require __DIR__ . '/../includes/db.php';

session_start();

$redirect = $_GET['redirect'] ?? '';
if (!is_string($redirect) || $redirect === '') {
    $redirect = '';
}
if ($redirect !== '' && (preg_match('/^[a-zA-Z][a-zA-Z0-9+.-]*:/', $redirect) || str_starts_with($redirect, '//'))) {
    $redirect = '';
}

// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usernameOrEmail = $_POST['username_email'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $result = loginUser($usernameOrEmail, $password);
    
    if ($result['success']) {
        $_SESSION['user_id'] = $result['user']['id'];
        $_SESSION['username'] = $result['user']['username'];

        if ($redirect !== '') {
            header('Location: ' . $redirect);
        } elseif (hasUserAssessment($result['user']['id'])) {
            header('Location: results.php');
        } else {
            header('Location: assessment.php');
        }
        exit;
    } else {
        $error = $result['message'];
    }
}

$active = 'login';
require __DIR__ . '/../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4 p-md-5">
                <h1 class="h3 fw-bold text-center mb-4">تسجيل الدخول</h1>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <form method="POST" action="login.php">
                    <div class="mb-3">
                        <label for="username_email" class="form-label fw-bold">اسم المستخدم أو البريد الإلكتروني</label>
                        <input type="text" class="form-control" id="username_email" name="username_email" placeholder="mohamed123 أو example@email.com" required autofocus>
                    </div>
                    
                    <div class="mb-4">
                        <label for="password" class="form-label fw-bold">كلمة المرور</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="******" required>
                    </div>
                    
                    <button type="submit" class="btn btn-success w-100 fw-bold py-2">تسجيل الدخول</button>
                </form>
                
                <hr class="my-4">
                
                <div class="text-center">
                    <p class="text-muted mb-2">ليس لديك حساب؟</p>
                    <a href="register.php" class="btn btn-outline-primary fw-bold">إنشاء حساب جديد</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>
