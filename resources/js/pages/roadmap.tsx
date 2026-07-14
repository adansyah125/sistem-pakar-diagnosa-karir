import { Head, Link, router } from '@inertiajs/react';
import { CheckCircle2, Circle, MapPin, ScanLine, ChevronRight, BookOpen } from 'lucide-react';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Checkbox } from '@/components/ui/checkbox';
import { diagnosa, roadmap as roadmapRoute } from '@/routes';

type Career = {
    id: number;
    name: string;
    slug: string;
    icon: string | null;
};

type Item = {
    id: number;
    title: string;
    description: string;
    order: number;
    completed: boolean;
    completed_at: string | null;
};

type CfResult = {
    career_id: number;
    career_name: string;
    cf: number;
    percentage: number;
    conclusion: string;
    show_roadmap: boolean;
};

export default function Roadmap({
    careers = [],
    selectedCareerId = null,
    hasDiagnosis = false,
    items = [],
    progressCount = 0,
    totalItems = 0,
    cfResults = [] as CfResult[],
}: {
    careers: Career[];
    selectedCareerId: number | null;
    hasDiagnosis: boolean;
    items: Item[];
    progressCount: number;
    totalItems: number;
    cfResults: CfResult[];
}) {
    function selectCareer(careerId: number) {
        router.get(
            '/roadmap',
            { career_id: careerId },
            { preserveState: true, preserveScroll: true, replace: true },
        );
    }

    function toggleItem(itemId: number) {
        router.post(
            '/roadmap/toggle',
            { roadmap_item_id: itemId },
            { preserveState: true, preserveScroll: true, replace: true },
        );
    }

    const selectedCareer = careers.find((c) => c.id === selectedCareerId);
    const percentage = totalItems > 0 ? Math.round((progressCount / totalItems) * 100) : 0;

    function getConclusionColor(conclusion: string): string {
        if (conclusion === 'Sangat Sesuai') return 'text-green-600';
        if (conclusion === 'Sesuai') return 'text-blue-600';
        if (conclusion === 'Cukup Sesuai') return 'text-yellow-600';
        return 'text-red-600';
    }

    function getConclusionBg(conclusion: string): string {
        if (conclusion === 'Sangat Sesuai') return 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200';
        if (conclusion === 'Sesuai') return 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-200';
        if (conclusion === 'Cukup Sesuai') return 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200';
        return 'bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200';
    }

    function getProgressColor(percentage: number): string {
        if (percentage >= 80) return 'bg-green-500';
        if (percentage >= 60) return 'bg-blue-500';
        if (percentage >= 40) return 'bg-yellow-500';
        return 'bg-gray-300 dark:bg-gray-600';
    }

    const recommendedCareers = cfResults.filter((r) => r.show_roadmap);

    return (
        <>
            <Head title="Roadmap Belajar" />

            <div className="flex flex-col gap-8 p-4">
                <div>
                    <p className="mt-1 text-muted-foreground">
                        Pilih bidang karir dan ikuti roadmap pembelajaran langkah demi langkah.
                    </p>
                </div>

                {/* Hasil Diagnosa — Rekomendasi Karir */}
                {cfResults.length > 0 && (
                    <Card>
                        <CardHeader className="pb-3">
                            <CardTitle className="flex items-center gap-2 text-base">
                                <ScanLine className="size-4" />
                                Hasil Diagnosa — Rekomendasi Karir
                            </CardTitle>
                            <CardDescription>
                                Berdasarkan hasil diagnosis Certainty Factor, berikut karir yang
                                cocok untuk Anda:
                            </CardDescription>
                        </CardHeader>
                        <CardContent className="space-y-3">
                            {recommendedCareers.length > 0 ? (
                                recommendedCareers.map((r) => (
                                    <div key={r.career_id} className={`flex items-center justify-between rounded-lg border p-3 transition-colors ${
                                        selectedCareerId === r.career_id ? 'border-primary bg-primary/5' : ''
                                    }`}>
                                        <div className="flex items-center gap-3">
                                            <div>
                                                <p className="text-sm font-medium">{r.career_name}</p>
                                                <span className={`text-xs font-medium ${getConclusionColor(r.conclusion)}`}>
                                                    {r.conclusion} ({r.percentage}%)
                                                </span>
                                            </div>
                                        </div>
                                        <Button size="sm" variant={selectedCareerId === r.career_id ? 'default' : 'outline'} onClick={() => selectCareer(r.career_id)}>
                                            {selectedCareerId === r.career_id ? 'Sedang Dipelajari' : 'Lihat Roadmap'}
                                            {selectedCareerId !== r.career_id && <ChevronRight className="ml-1 size-3.5" />}
                                        </Button>
                                    </div>
                                ))
                            ) : (
                                <p className="text-sm text-muted-foreground">
                                    Belum ada rekomendasi karir. Silakan lakukan diagnosa terlebih dahulu.
                                </p>
                            )}
                        </CardContent>
                    </Card>
                )}

                {/* Career Selector */}
                {careers.length > 0 && (
                    <div className="flex flex-wrap gap-2">
                        {careers.map((career) => (
                            <Button
                                key={career.id}
                                variant={selectedCareerId === career.id ? 'default' : 'outline'}
                                size="sm"
                                onClick={() => selectCareer(career.id)}
                            >
                                {career.name}
                            </Button>
                        ))}
                    </div>
                )}

                {/* Progress & Items — Always visible */}
                {selectedCareer && items.length > 0 && (
                    <>
                        {/* Progress */}
                        <Card>
                            <CardHeader className="pb-3">
                                <CardTitle className="text-base">
                                    {selectedCareer.name}
                                </CardTitle>
                                <CardDescription>
                                    Progress pembelajaran
                                </CardDescription>
                            </CardHeader>
                            <CardContent>
                                <div className="flex items-center gap-3">
                                    <div className="h-2.5 flex-1 overflow-hidden rounded-full bg-muted">
                                        <div
                                            className="h-full rounded-full bg-primary transition-all duration-500"
                                            style={{ width: `${percentage}%` }}
                                        />
                                    </div>
                                    <span className="text-sm font-medium tabular-nums">
                                        {progressCount}/{totalItems}
                                    </span>
                                </div>
                            </CardContent>
                        </Card>

                        {/* Items */}
                        <div className="space-y-3">
                            {items.map((item) => (
                                <Card
                                    key={item.id}
                                    className={`transition-colors ${
                                        item.completed
                                            ? 'border-green-200 bg-green-50/50 dark:border-green-800 dark:bg-green-950/20'
                                            : ''
                                    }`}
                                >
                                    <CardContent className="flex items-start gap-4 py-4">
                                        <Checkbox
                                            id={`item-${item.id}`}
                                            checked={item.completed}
                                            onCheckedChange={() => toggleItem(item.id)}
                                            className="mt-1"
                                        />
                                        <div className="flex-1 space-y-1">
                                            <label
                                                htmlFor={`item-${item.id}`}
                                                className={`cursor-pointer text-sm font-medium leading-none peer-disabled:cursor-not-allowed peer-disabled:opacity-70 ${
                                                    item.completed
                                                        ? 'line-through text-muted-foreground'
                                                        : ''
                                                }`}
                                            >
                                                {item.title}
                                            </label>
                                            <p className="text-xs text-muted-foreground">
                                                {item.description}
                                            </p>
                                            {item.completed_at && (
                                                <p className="text-xs text-green-600">
                                                    Selesai: {item.completed_at}
                                                </p>
                                            )}
                                        </div>
                                        {item.completed ? (
                                            <CheckCircle2 className="mt-0.5 size-5 shrink-0 text-green-500" />
                                        ) : (
                                            <Circle className="mt-0.5 size-5 shrink-0 text-muted-foreground/30" />
                                        )}
                                    </CardContent>
                                </Card>
                            ))}
                        </div>
                    </>
                )}

                {/* Roadmap Not Available */}
                {selectedCareer && items.length === 0 && (
                    <Card>
                        <CardContent className="flex flex-col items-center gap-4 py-12">
                            <MapPin className="size-12 text-muted-foreground/50" />
                            <div className="text-center">
                                <p className="font-medium">Roadmap belum tersedia</p>
                                <p className="mt-1 text-sm text-muted-foreground">
                                    Belum ada roadmap untuk {selectedCareer.name}.
                                </p>
                            </div>
                        </CardContent>
                    </Card>
                )}

                {/* Prompt when no career selected (just in case) */}
                {!selectedCareer && (
                    <Card>
                        <CardContent className="flex flex-col items-center gap-4 py-12">
                            <BookOpen className="size-12 text-muted-foreground/50" />
                            <div className="text-center">
                                <p className="font-medium">Pilih Bidang Karir</p>
                                <p className="mt-1 text-sm text-muted-foreground">
                                    Pilih bidang karir di atas untuk melihat roadmap pembelajaran.
                                </p>
                            </div>
                        </CardContent>
                    </Card>
                )}
            </div>
        </>
    );
}

Roadmap.layout = {
    breadcrumbs: [
        {
            title: 'Roadmap Belajar',
            href: roadmapRoute(),
        },
    ],
};
