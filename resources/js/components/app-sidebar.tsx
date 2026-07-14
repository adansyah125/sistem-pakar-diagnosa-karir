import { Link } from '@inertiajs/react';
import { BookOpen, FolderGit2, LayoutGrid,ScanLine,History,Map,HardDrive } from 'lucide-react';
import AppLogo from '@/components/app-logo';
import { NavFooter } from '@/components/nav-footer';
import { NavMain } from '@/components/nav-main';
import { NavUser } from '@/components/nav-user';
import {
    Sidebar,
    SidebarContent,
    SidebarFooter,
    SidebarHeader,
    SidebarMenu,
    SidebarMenuButton,
    SidebarMenuItem,
} from '@/components/ui/sidebar';
import { dashboard, dataDiagnosa, diagnosa,riwayat,roadmap } from '@/routes';
import type { NavItem } from '@/types';

const mainNavItems: NavItem[] = [
    {
        title: 'Dashboard',
        href: dashboard(),
        icon: LayoutGrid,
    },
    {
        title: 'Karir di Bidang IT',
        href: dataDiagnosa(),
        icon: HardDrive,
    },
    {
        title: 'Diagnosa Karir',
        href: diagnosa(),
        icon: ScanLine,
    },
    {
        title: 'Riwayat Diagnosa',
        href: riwayat(),
        icon: History,
    },
    {
        title: 'Roadmap',
        href: roadmap(),
        icon: Map,
    },
];

const footerNavItems: NavItem[] = [
    {
        title: 'Repository',
        href: 'https://github.com/adansyah125/sistem-pakar-diagnosa-karir',
        icon: FolderGit2,
    },
    {
        title: 'Documentation',
        href: 'https://github.com/adansyah125',
        icon: BookOpen,
    },
];

export function AppSidebar() {
    return (
        <Sidebar collapsible="icon" variant="inset">
            <SidebarHeader>
                <SidebarMenu>
                    <SidebarMenuItem>
                        <SidebarMenuButton size="lg" asChild>
                            <Link href={dashboard()} prefetch>
                                <AppLogo />
                            </Link>
                        </SidebarMenuButton>
                    </SidebarMenuItem>
                </SidebarMenu>
            </SidebarHeader>

            <SidebarContent>
                <NavMain items={mainNavItems} />
            </SidebarContent>

            <SidebarFooter>
                <NavFooter items={footerNavItems} className="mt-auto" />
                <NavUser />
            </SidebarFooter>
        </Sidebar>
    );
}
