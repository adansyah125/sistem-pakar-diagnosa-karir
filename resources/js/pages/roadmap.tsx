import { Head, router } from '@inertiajs/react';
import { CheckCircle2, Circle, MapPin, ScanLine, Lock } from 'lucide-react';
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

export default function Roadmap({
    careers = [],
    diagnosedCareerIds = [] as number[],
    selectedCareerId = null,
    hasDiagnosis = false,
    items = [],
    progressCount = 0,
    totalItems = 0,
}: {
    careers: Career[];
    diagnosedCareerIds: number[];
    selectedCareerId: number | null;
    hasDiagnosis: boolean;
    items: Item[];
    progressCount: number;
    totalItems: number;
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

    return (
        <>
            <Head title="Roadmap Belajar" />

            <div className="flex flex-col gap-8 p-4">
                <div>
                    <p className="mt-1 text-muted-foreground">
                        Pilih bidang karir dan ikuti roadmap pembelajaran langkah demi langkah.
                    </p>
                </div>

                {/* Career Selector */}
                {careers.length > 0 && (
                    <div className="flex flex-wrap gap-2">
                        {careers.map((career) => {
                            // eslint-disable-next-line @typescript-eslint/no-unused-vars
                            const isDiagnosed = diagnosedCareerIds.includes(career.id);
                            // eslint-disable-next-line @stylistic/padding-line-between-statements
                            return (
                                <Button
                                    key={career.id}
                                    variant={selectedCareerId === career.id ? 'default' : 'outline'}
                                    size="sm"
                                    onClick={() => selectCareer(career.id)}
                                >
                                    {career.name}
                                </Button>
                            );
                        })}
                    </div>
                )}

                {/* Not Diagnosed Yet */}
                {selectedCareer && !hasDiagnosis && (
                    <Card>
                        <CardContent className="flex flex-col items-center gap-4 py-12">
                            <Lock className="size-12 text-muted-foreground/50" />
                            <div className="text-center">
                                <p className="font-medium">Belum Ada Diagnosa</p>
                                <p className="mt-1 text-sm text-muted-foreground">
                                    Anda belum melakukan diagnosa untuk bidang <strong>{selectedCareer.name}</strong>.
                                    Silahkan diagnosa terlebih dahulu untuk membuka roadmap belajar.
                                </p>
                            </div>
                            <Button asChild>
                                <a href={diagnosa.url({ query: { career_id: selectedCareer.id } })}>
                                    <ScanLine className="mr-2 size-4" />
                                    Diagnosa {selectedCareer.name}
                                </a>
                            </Button>
                        </CardContent>
                    </Card>
                )}

                {/* Diagnosed - Show Roadmap */}
                {selectedCareer && hasDiagnosis && items.length > 0 && (
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
                {selectedCareer && hasDiagnosis && items.length === 0 && (
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
