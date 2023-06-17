import list from "@/routes/list.js";

function route(name) {
    let url = list.filter((route) => route.name === name)
    if (url.length === 0) {
        throw new Error("Route " + name + " not found");
    }
    return url[0];
}

function current(name) {
    return route(name).path === location.href;
}

export {route, current};
