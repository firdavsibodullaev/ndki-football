const list = [
    {
        text: 'Главная страница',
        name: "admin.index",
        method: 'get',
        path: getUrl('admin')
    },
    {
        text: 'Команды',
        name: "admin.team.index",
        method: 'get',
        path: getUrl('admin/team')
    },
    {
        text: 'Профиль',
        name: "admin.profile.edit",
        method: 'get',
        path: getUrl('admin/profile')
    },
    {
        text: 'Профиль изменить',
        name: "admin.profile.update",
        method: 'patch',
        path: getUrl('admin/profile')
    },
    {
        text: 'Профиль удалить',
        name: "admin.profile.destroy",
        method: 'delete',
        path: getUrl('admin/profile')
    },
    {
        text: 'Пароль',
        name: "admin.password.update",
        method: 'put',
        path: getUrl('admin/password')
    },
    {
        text: 'Вход',
        name: "login",
        method: 'post',
        path: getUrl('login')
    },
    {
        text: 'Выход',
        name: "logout",
        method: 'post',
        path: getUrl('logout')
    },
];

function getUrl(path) {
    let baseUrl = import.meta.env.VITE_APP_URL + '/';

    baseUrl = baseUrl.replace(/\/$/, '', baseUrl);

    return `${baseUrl}/${path}`;
}

export default list;
