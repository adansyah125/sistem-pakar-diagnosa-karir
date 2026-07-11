import { Head } from '@inertiajs/react';
import {
    BarChart,
    Bar,
    XAxis,
    YAxis,
    CartesianGrid,
    Tooltip,
    ResponsiveContainer,
} from 'recharts';
// eslint-disable-next-line import/order
import { BarChart3, ClipboardList, History } from 'lucide-react';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { dashboard } from '@/routes';

type CareerDistItem = {
    career_name: string;
    total: number;
};

export default function Dashboard({
    totalDiagnosa = 0,
    userRiwayatCount = 0,
    careerDistribution = [] as CareerDistItem[],
    // eslint-disable-next-line @typescript-eslint/no-unused-vars
    maxTotal = 1,
}: {
    totalDiagnosa: number;
    userRiwayatCount: number;
    careerDistribution: CareerDistItem[];
    maxTotal: number;
}) {
    return (
        <>
            <Head title="Dashboard" />

            <div className="flex flex-col gap-8 p-4">
                {/* <div>
                    <h1 className="text-2xl font-semibold tracking-tight">Dashboard</h1>
                    <p className="mt-1 text-muted-foreground">
                        Ringkasan data diagnosa karir IT.
                    </p>
                </div> */}

                {/* Stat Cards */}
                <div className="grid gap-4 md:grid-cols-2">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between pb-2">
                            <CardTitle className="text-sm font-medium">
                                Total Data Diagnosa
                            </CardTitle>
                            <ClipboardList className="size-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <p className="text-3xl font-bold">{totalDiagnosa}</p>
                            <p className="text-xs text-muted-foreground">
                                Seluruh diagnosa yang pernah dilakukan
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between pb-2">
                            <CardTitle className="text-sm font-medium">
                                Riwayat Diagnosa Saya
                            </CardTitle>
                            <History className="size-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <p className="text-3xl font-bold">{userRiwayatCount}</p>
                            <p className="text-xs text-muted-foreground">
                                Jumlah diagnosa yang pernah Anda lakukan
                            </p>
                        </CardContent>
                    </Card>
                </div>

                {/* Career Distribution Chart */}
                <Card>
                    <CardHeader>
                        <div className="flex items-center gap-2">
                            <BarChart3 className="size-5 text-muted-foreground" />
                            <div>
                                <CardTitle className="text-base">
                                    Minat Bidang Karir IT
                                </CardTitle>
                                <CardDescription>
                                    Distribusi diagnosa berdasarkan bidang karir
                                </CardDescription>
                            </div>
                        </div>
                    </CardHeader>
                    <CardContent>
                        {careerDistribution.length === 0 ? (
                            <p className="py-8 text-center text-sm text-muted-foreground">
                                Belum ada data diagnosa untuk ditampilkan.
                            </p>
                        ) : (
                            <div className="h-80">
                                <ResponsiveContainer width="100%" height="100%">
                                    <BarChart
                                        data={careerDistribution}
                                        margin={{ top: 10, right: 10, left: -10, bottom: 0 }}
                                        barCategoryGap="20%"
                                    >
                                        <CartesianGrid strokeDasharray="3 3" className="stroke-muted" />
                                        <XAxis
                                            dataKey="career_name"
                                            tick={{ fontSize: 12 }}
                                            className="text-muted-foreground"
                                            axisLine={false}
                                            tickLine={false}
                                        />
                                        <YAxis
                                            className="text-muted-foreground"
                                            axisLine={false}
                                            tickLine={false}
                                            allowDecimals={false}
                                        />
                                        <Tooltip
                                            contentStyle={{
                                                borderRadius: '8px',
                                                border: '1px solid hsl(var(--border))',
                                                background: 'hsl(var(--card))',
                                            }}
                                            labelStyle={{ fontWeight: 600 }}
                                        />
                                        <Bar
                                            dataKey="total"
                                            fill="hsl(var(--primary))"
                                            radius={[4, 4, 0, 0]}
                                            maxBarSize={50}
                                        />
                                    </BarChart>
                                </ResponsiveContainer>
                            </div>
                        )}
                    </CardContent>
                </Card>
            </div>
        </>
    );
}

Dashboard.layout = {
    breadcrumbs: [
        {
            title: 'Dashboard',
            href: dashboard(),
        },
    ],
};
