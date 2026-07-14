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
import { BarChart3, ClipboardList, Target, Star } from 'lucide-react';
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
    uniqueCareerCount = 0,
    bestCareer = null,
    careerDistribution = [] as CareerDistItem[],
    // eslint-disable-next-line @typescript-eslint/no-unused-vars
    maxTotal = 1,
}: {
    totalDiagnosa: number;
    uniqueCareerCount: number;
    bestCareer: string | null;
    careerDistribution: CareerDistItem[];
    maxTotal: number;
}) {
    return (
        <>
            <Head title="Dashboard" />

            <div className="flex flex-col gap-8 p-4">
                {/* Stat Cards */}
                <div className="grid gap-4 md:grid-cols-3">
                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between pb-2">
                            <CardTitle className="text-sm font-medium">
                                Total Diagnosa
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
                                Karir Didiagnosa
                            </CardTitle>
                            <Target className="size-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <p className="text-3xl font-bold">{uniqueCareerCount}</p>
                            <p className="text-xs text-muted-foreground">
                                Jumlah bidang karir yang pernah di diagnosa
                            </p>
                        </CardContent>
                    </Card>

                    <Card>
                        <CardHeader className="flex flex-row items-center justify-between pb-2">
                            <CardTitle className="text-sm font-medium">
                                Karir Paling Cocok
                            </CardTitle>
                            <Star className="size-4 text-muted-foreground" />
                        </CardHeader>
                        <CardContent>
                            <p className={`text-3xl font-bold ${bestCareer ? '' : 'text-muted-foreground'}`}>
                                {bestCareer ?? '-'}
                            </p>
                            <p className="text-xs text-muted-foreground">
                                {bestCareer
                                    ? 'Bidang dengan skor tertinggi'
                                    : 'Belum ada diagnosa'}
                            </p>
                        </CardContent>
                    </Card>
                </div>

                {/* Career Distribution Line Chart */}
                <Card>
                    <CardHeader>
                        <div className="flex items-center gap-2">
                            <BarChart3 className="size-5 text-muted-foreground" />
                            <div>
                                <CardTitle className="text-base">
                                    Minat Bidang Karir IT
                                </CardTitle>
                                <CardDescription>
                                    Jumlah diagnosa per bidang karir
                                </CardDescription>
                            </div>
                        </div>
                    </CardHeader>
                    <CardContent>
                        {careerDistribution.every((d) => d.total === 0) ? (
                            <p className="py-8 text-center text-sm text-muted-foreground">
                                Belum ada data diagnosa untuk ditampilkan.
                            </p>
                        ) : (
                            <div className="h-80">
                                <ResponsiveContainer width="100%" height="100%">
                                    <BarChart
                                        data={careerDistribution}
                                        margin={{ top: 10, right: 20, left: -10, bottom: 0 }}
                                        barCategoryGap="25%"
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
