export default class ApiLocation {
    static LOGIN() {
        return '/login';
    }

    static REGISTER() {
        return '/register';
    }

    static RESET_PASSWORD()
    {
        return '/password/reset-password';
    }

    static DASHBOARD() {
        return '/admin/dashboard';
    }

    static FORGET_PASSWORD() {
        return '/password/forget-password';
    }

    static CHANGE_PASSWORD() {
        return '/password/change-password';
    }

    static path(uri) {
        window.location.href = uri;
    }
}
