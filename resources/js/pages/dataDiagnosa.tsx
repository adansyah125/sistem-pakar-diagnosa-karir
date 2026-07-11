import { Head } from '@inertiajs/react';
import {
    BarChart3,
    Code2,
    Container,
    Globe,
    Monitor,
    Palette,
    Smartphone,
} from 'lucide-react';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { dataDiagnosa as dataDiagnosaRoute } from '@/routes';

const iconMap: Record<string, React.ComponentType<{ className?: string }>> = {
    Monitor,
    Code2,
    Globe,
    Smartphone,
    Container,
    Palette,
    BarChart3,
};

type Career = {
    id: number;
    name: string;
    slug: string;
    description: string;
    icon: string | null;
    skills: string[];
};

export default function DataDiagnosa({ careers }: { careers: Career[] }) {
    return (
        <>
            <Head title="Data Diagnosa Karir IT" />

            <div className="flex flex-col gap-8 p-4">
                    {/* <div>
                        <h1 className="text-2xl font-semibold tracking-tight">
                            Data Diagnosa Karir IT
                        </h1>
                        <p className="mt-1 text-muted-foreground">
                            Berikut adalah daftar karir di bidang IT beserta deskripsi dan keahlian
                            yang dibutuhkan.
                        </p>
                    </div> */}

                <div className="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    {careers.map((career) => {
                        const Icon = iconMap[career.icon ?? ''] ?? Code2;

                        return (
                            <Card key={career.id}>
                                <CardHeader>
                                    <div className="mb-1 flex items-center gap-3">
                                        <Icon className="size-6 text-muted-foreground" />
                                        <CardTitle>{career.name}</CardTitle>
                                    </div>
                                    <CardDescription>{career.description}</CardDescription>
                                </CardHeader>
                                <CardContent>
                                    <h4 className="mb-2 text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                                        Keahlian:
                                    </h4>
                                    <div className="flex flex-wrap gap-1.5">
                                        {career.skills.map((skill) => (
                                            <span
                                                key={skill}
                                                className="inline-block rounded-full bg-muted px-2.5 py-0.5 text-xs font-medium text-muted-foreground"
                                            >
                                                {skill}
                                            </span>
                                        ))}
                                    </div>
                                </CardContent>
                            </Card>
                        );
                    })}
                </div>
            </div>
        </>
    );
}

DataDiagnosa.layout = {
    breadcrumbs: [
        {
            title: 'Data Diagnosa',
            href: dataDiagnosaRoute(),
        },
    ],
};
