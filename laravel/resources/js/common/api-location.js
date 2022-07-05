export default class ApiLocation {
    static LOGIN() {
        return '/login';
    }

    static LOGIN1() {
        return '/login1';
    }

    static path(uri) {
        window.location.href = uri;
    }
}
