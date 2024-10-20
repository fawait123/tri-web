import { IMenu } from "@/interface";
import { Calendar, Home, Notebook, NotebookPen, SquareActivity, Users } from "lucide-vue-next";

export const menuItem: IMenu[] = [
    {
        icon: Home,
        label: "Dashboard",
        link: '/dashboard',
        activeLink: "dashboard"
    },
    {
        icon: Users,
        label: "Kelola Pengguna",
        link: '/user',
        activeLink: "user"
    },
    {
        icon: Calendar,
        label: "Menggosok Gigi",
        link: '/brushing-teeth',
        activeLink: "brushing-teeth"
    },
    {
        icon: SquareActivity,
        label: "Edukasi",
        link: '/education',
        activeLink: "education"
    }
]
