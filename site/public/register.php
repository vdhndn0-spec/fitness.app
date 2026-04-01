<?php
/**
 * User Registration Page
 */
require __DIR__ . '/../includes/db.php';

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = trim($_POST['email'] ?? '');
    $data = [
        'username' => $email, // use email as username
        'email' => $email,
        'password' => $_POST['password'] ?? '',
        'name' => $_POST['name'] ?? ''
    ];
    
    $result = registerUser($data);
    
    if ($result['success']) {
        // Auto-login and redirect to assessment
        session_start();
        $_SESSION['user_id'] = $result['user_id'];
        header('Location: assessment.php?new=1');
        exit;
    } else {
        $error = $result['message'];
    }
}

$active = 'register';
require __DIR__ . '/../includes/header.php';
?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-5">
        <div class="card shadow-sm">
            <div class="card-body p-4 p-md-5">
                <h1 class="h3 fw-bold text-center mb-4">إنشاء حساب جديد</h1>
                
                <?php if ($error): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                
                <?php if ($success): ?>
                    <div class="alert alert-success">تم إنشاء الحساب بنجاح! جاري تحويلك...</div>
                    <div class="text-center">
                        <a href="assessment.php" class="btn btn-success fw-bold">استمر للتقييم</a>
                    </div>
                <?php else: ?>
                    <form method="POST" action="register.php">
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">الاسم الكامل</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="محمد أحمد" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">البريد الإلكتروني</label>
                            <input type="email" class="form-control" id="email" name="email" placeholder="example@email.com" required>
                        </div>
                        
                        <div class="mb-4">
                            <label for="password" class="form-label fw-bold">كلمة المرور</label>
                            <input type="password" class="form-control" id="password" name="password" placeholder="******" minlength="6" required>
                            <div class="form-text small">6 أحرف على الأقل</div>
                        </div>
                        
                        <button type="submit" class="btn btn-success w-100 fw-bold py-2">إنشاء الحساب</button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <div class="text-center">
                        <p class="text-muted mb-2">لديك حساب بالفعل؟</p>
                        <a href="login.php" class="btn btn-outline-primary fw-bold">تسجيل الدخول</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../includes/footer.php'; ?>
