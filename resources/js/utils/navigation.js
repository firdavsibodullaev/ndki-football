import {current, route} from "@/utils/routes.js";

let adminIndex = route("admin.index");
let teams = route("admin.team.index");

const navigation = [
    {
        path: adminIndex.path,
        name: adminIndex.name,
        text: adminIndex.text,
        current: current("admin.index"),
    },
    {
        text: 'Команды',
        children: [
            {
                path: teams.path,
                name: teams.name,
                text: teams.text,
                current: current("admin.team.index"),
            }
        ],
    },
];

export default navigation;
