import { current, route } from "@/utils/routes.js";

let adminIndex = route("admin.index");

const navigation = [
    {
        path: adminIndex.path,
        name: adminIndex.name,
        text: adminIndex.text,
        current: current("admin.index"),
    },
    {
        text: adminIndex.text,
        children: [
            {
                path: adminIndex.path,
                name: adminIndex.name,
                text: adminIndex.text,
                current: current("admin.index"),
            },
            {
                path: adminIndex.path,
                name: adminIndex.name,
                text: adminIndex.text,
                current: current("admin.index"),
            },
        ],
    },
];

export default navigation;
