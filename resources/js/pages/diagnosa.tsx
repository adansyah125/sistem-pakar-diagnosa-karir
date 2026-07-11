import { Head, router } from '@inertiajs/react';
import { ArrowLeft, ArrowRight, Check, ChevronRight, ScanLine,Code2, X } from 'lucide-react';
import { useEffect, useState } from 'react';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { diagnosa as diagnosaRoute } from '@/routes';

type Career = {
    id: number;
    name: string;
    slug: string;
    description: string;
    icon: string | null;
    skills: string[];
};

type Option = {
    label: string;
    score: number;
};

type Question = {
    id: number;
    career_id: number;
    question: string;
    options: Option[];
    order: number;
};

type DiagnosisResult = {
    id: number;
    career_name: string;
    education: string | null;
    skills: string | null;
    answers: number[];
    total_score: number;
    max_score: number;
    percentage: number;
    conclusion: string;
};

export default function Diagnosa({
    careers = [],
    questions = {},
    diagnosisResult = null,
}: {
    careers: Career[];
    questions: Record<number, Question[]>;
    diagnosisResult: DiagnosisResult | null;
}) {
    const [showResult, setShowResult] = useState(false);
    const [step, setStep] = useState(1);

    useEffect(() => {
        if (diagnosisResult) {
            // eslint-disable-next-line react-hooks/set-state-in-effect
            setShowResult(true);
            setStep(4);
        }
    }, [diagnosisResult]);
    const [selectedCareer, setSelectedCareer] = useState<Career | null>(null);
    const [education, setEducation] = useState('');
    const [skills, setSkills] = useState('');
    const [localAnswers, setLocalAnswers] = useState<Record<number, number>>({});
    const [submitting, setSubmitting] = useState(false);

    const currentQuestions: Question[] = selectedCareer
        ? (questions[selectedCareer.id] ?? [])
        : [];

    const allAnswered =
        currentQuestions.length > 0 &&
        currentQuestions.every((q) => localAnswers[q.order] !== undefined);

    function handleSubmit() {
        // eslint-disable-next-line curly
        if (!selectedCareer || !allAnswered) return;

        setSubmitting(true);

        const orderedAnswers = currentQuestions
            .sort((a, b) => a.order - b.order)
            .map((q) => localAnswers[q.order]);

        router.post(
            '/diagnosa',
            {
                career_id: selectedCareer.id,
                education,
                skills,
                answers: orderedAnswers,
            },
            {
                preserveScroll: true,
                onFinish: () => setSubmitting(false),
            },
        );
    }

    function handleReset() {
        setShowResult(false);
        setStep(1);
        setSelectedCareer(null);
        setEducation('');
        setSkills('');
        setLocalAnswers({});
    }

    const optionLabels = ['A', 'B', 'C', 'D'];

    function getConclusionColor(conclusion: string): string {
        // eslint-disable-next-line curly
        if (conclusion === 'Sangat Sesuai') return 'text-green-600';

        // eslint-disable-next-line curly
        if (conclusion === 'Sesuai') return 'text-blue-600';

        // eslint-disable-next-line curly
        if (conclusion === 'Cukup Sesuai') return 'text-yellow-600';

        return 'text-red-600';
    }

    const isResult = !!diagnosisResult && showResult;

    return (
        <>
            <Head title={isResult ? 'Hasil Diagnosa Karir' : 'Diagnosa Karir'} />

            <div className="mx-auto flex p-4 flex-col gap-8">
                {!isResult && (
                    <>
                        {/* <div>
                            <h1 className="text-2xl font-semibold tracking-tight mt-3">
                                Diagnosa Karir IT
                            </h1>
                            <p className="mt-1 text-muted-foreground">
                                Ikuti langkah-langkah berikut untuk mengetahui kesesuaian karir IT
                                Anda.
                            </p>
                        </div> */}

                        

                        {/* STEP 1: Pilih Karir */}
                        {step === 1 && (
                            <div className="space-y-6">
                                <p className="text-sm text-muted-foreground">
                                    Silakan pilih salah satu karir IT yang ingin Anda diagnosis:
                                </p>
                                {/* Progress */}
                        <div className="flex items-center gap-2">
                            {[1, 2, 3].map((s) => (
                                <div key={s} className="flex items-center gap-2">
                                    <div
                                        className={`flex size-8 items-center justify-center rounded-full text-sm font-medium ${
                                            step >= s
                                                ? 'bg-primary text-primary-foreground'
                                                : 'bg-muted text-muted-foreground'
                                        }`}
                                    >
                                        {step > s ? <Check className="size-4" /> : s}
                                    </div>
                                    <span
                                        className={`hidden text-sm sm:inline ${
                                            step >= s ? 'font-medium' : 'text-muted-foreground'
                                        }`}
                                    >
                                        {s === 1 ? 'Pilih Karir' : s === 2 ? 'Data Diri' : 'Test Soal'}
                                    </span>
                                    {s < 3 && (
                                        <ChevronRight className="size-4 text-muted-foreground" />
                                    )}
                                </div>
                            ))}
                        </div>
                                <div className="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
                                    {careers.map((career) => (
                                        <Card
                                            key={career.id}
                                            className={`cursor-pointer transition-all hover:shadow-md ${
                                                selectedCareer?.id === career.id
                                                    ? 'ring-2 ring-primary'
                                                    : ''
                                            }`}
                                            onClick={() => setSelectedCareer(career)}
                                        >
                                            <CardHeader>
                                                <div className="flex items-center gap-3">
                                                    <div className="flex size-10 items-center justify-center rounded-lg bg-primary/10">
                                                        <Code2 className="size-5 text-primary" />
                                                    </div>
                                                    <div>
                                                        <CardTitle className="text-base">
                                                            {career.name}
                                                        </CardTitle>
                                                        {selectedCareer?.id === career.id && (
                                                            <p className="text-xs font-medium text-primary">
                                                                Dipilih
                                                            </p>
                                                        )}
                                                    </div>
                                                </div>
                                            </CardHeader>
                                            <CardContent>
                                                <CardDescription className="line-clamp-3">
                                                    {career.description}
                                                </CardDescription>
                                            </CardContent>
                                        </Card>
                                    ))}
                                </div>
                                <div className="flex justify-end mb-5">
                                    <Button
                                        disabled={!selectedCareer}
                                        onClick={() => setStep(2)}
                                    >
                                        Lanjut
                                        <ArrowRight className="ml-2 size-4" />
                                    </Button>
                                </div>
                            </div>
                        )}

                        {/* STEP 2: Data Diri */}
                        {step === 2 && (
                            <div className="space-y-6">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>Data Pendukung</CardTitle>
                                        <CardDescription>
                                            Isi pendidikan terakhir dan keahlian yang Anda miliki.
                                        </CardDescription>
                                    </CardHeader>
                                    <CardContent className="space-y-4">
                                        <div className="grid gap-2">
                                            <Label htmlFor="education">Pendidikan Terakhir</Label>
                                            <Input
                                                id="education"
                                                value={education}
                                                onChange={(e) => setEducation(e.target.value)}
                                                placeholder="S1 Teknik Informatika"
                                            />
                                        </div>
                                        <div className="grid gap-2">
                                            <Label htmlFor="skills">Keahlian Saya</Label>
                                            <textarea
                                                id="skills"
                                                value={skills}
                                                onChange={(e) => setSkills(e.target.value)}
                                                placeholder="PHP, Laravel, React, JavaScript, ..."
                                                rows={4}
                                                className="border-input file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground flex min-h-20 w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                                            />
                                            <p className="text-xs text-muted-foreground">
                                                Pisahkan dengan koma untuk setiap keahlian.
                                            </p>
                                        </div>
                                    </CardContent>
                                </Card>
                                <div className="flex items-center justify-between">
                                    <Button variant="outline" onClick={() => setStep(1)}>
                                        <ArrowLeft className="mr-2 size-4" />
                                        Kembali
                                    </Button>
                                    <Button onClick={() => setStep(3)}>
                                        Mulai Test
                                        <ArrowRight className="ml-2 size-4" />
                                    </Button>
                                </div>
                            </div>
                        )}

                        {/* STEP 3: Test Soal */}
                        {step === 3 && (
                            <div className="space-y-6">
                                <Card>
                                    <CardHeader>
                                        <CardTitle>
                                            Test Soal -{' '}
                                            <span className="text-primary">
                                                {selectedCareer?.name}
                                            </span>
                                        </CardTitle>
                                        <CardDescription>
                                            Jawab 10 soal pilihan ganda berikut dengan jujur sesuai
                                            kemampuan Anda. Setiap jawaban akan dinilai untuk
                                            menentukan kesesuaian karir Anda.
                                        </CardDescription>
                                    </CardHeader>
                                    <CardContent className="space-y-8">
                                        {currentQuestions
                                            .sort((a, b) => a.order - b.order)
                                            .map((q) => (
                                                <div key={q.id} className="space-y-3">
                                                    <p className="text-sm font-medium">
                                                        {q.order}. {q.question}
                                                    </p>
                                                    <div className="grid gap-2">
                                                        {q.options.map((opt, idx) => (
                                                            <button
                                                                key={idx}
                                                                type="button"
                                                                onClick={() =>
                                                                    setLocalAnswers((prev) => ({
                                                                        ...prev,
                                                                        [q.order]: idx,
                                                                    }))
                                                                }
                                                                className={`flex items-start gap-3 rounded-lg border p-3 text-left text-sm transition-all ${
                                                                    localAnswers[q.order] === idx
                                                                        ? 'border-primary bg-primary/5 ring-1 ring-primary'
                                                                        : 'bg-background hover:bg-muted'
                                                                }`}
                                                            >
                                                                <div
                                                                    className={`flex size-5 shrink-0 items-center justify-center rounded-full border text-xs font-medium ${
                                                                        localAnswers[q.order] ===
                                                                        idx
                                                                            ? 'border-primary bg-primary text-primary-foreground'
                                                                            : 'border-muted-foreground'
                                                                    }`}
                                                                >
                                                                    {optionLabels[idx]}
                                                                </div>
                                                                <span className="pt-px">
                                                                    {opt.label}
                                                                </span>
                                                            </button>
                                                        ))}
                                                    </div>
                                                </div>
                                            ))}
                                    </CardContent>
                                </Card>

                                <div className="flex items-center justify-between mb-5">
                                    <Button variant="outline" onClick={() => setStep(2)}>
                                        <ArrowLeft className="mr-2 size-4" />
                                        Kembali
                                    </Button>
                                    <div className="flex items-center gap-2">
                                        <span className="text-sm text-muted-foreground">
                                            {Object.keys(localAnswers).length} /{' '}
                                            {currentQuestions.length} terjawab
                                        </span>
                                        <Button
                                            disabled={!allAnswered || submitting}
                                            onClick={handleSubmit}
                                        >
                                            {submitting ? 'Memproses...' : 'Lihat Hasil'}
                                            <ScanLine className="ml-2 size-4" />
                                        </Button>
                                    </div>
                                </div>
                            </div>
                        )}
                    </>
                )}

                {/* STEP 4: HASIL DIAGNOSA */}
                {isResult && diagnosisResult && (
                    <div className="flex flex-col gap-8 mt-3">
                        {/* <div>
                            <h1 className="text-2xl font-semibold tracking-tight">
                                Hasil Diagnosa Karir
                            </h1>
                            <p className="mt-1 text-muted-foreground">
                                Berikut adalah hasil lengkap diagnosis kesesuaian karir IT Anda.
                            </p>
                        </div> */}

                        {/* Ringkasan */}
                        <div className="grid gap-6 md:grid-cols-3">
                            <Card>
                                <CardHeader className="pb-3">
                                    <CardDescription>Karir yang dipilih</CardDescription>
                                    <CardTitle className="text-lg">{diagnosisResult.career_name}</CardTitle>
                                </CardHeader>
                            </Card>

                            <Card>
                                <CardHeader className="pb-3">
                                    <CardDescription>Skor Test</CardDescription>
                                    <div className="flex items-baseline gap-1">
                                        <CardTitle className="text-lg">
                                            {diagnosisResult.total_score}
                                        </CardTitle>
                                        <span className="text-sm text-muted-foreground">
                                            / {diagnosisResult.max_score}
                                        </span>
                                    </div>
                                </CardHeader>
                                <CardContent className="pt-0">
                                    <div className="h-2 w-full rounded-full bg-muted">
                                        <div
                                            className="h-2 rounded-full bg-primary transition-all"
                                            style={{ width: `${diagnosisResult.percentage}%` }}
                                        />
                                    </div>
                                </CardContent>
                            </Card>

                            <Card>
                                <CardHeader className="pb-3">
                                    <CardDescription>Kesimpulan</CardDescription>
                                    <CardTitle
                                        className={`text-lg ${getConclusionColor(diagnosisResult.conclusion)}`}
                                    >
                                        {diagnosisResult.conclusion}
                                    </CardTitle>
                                </CardHeader>
                                <CardContent className="pt-0">
                                    <p className="text-xs text-muted-foreground">
                                        {diagnosisResult.percentage}% tingkat kesesuaian
                                    </p>
                                </CardContent>
                            </Card>
                        </div>

                        {/* Detail Jawaban */}
                        <Card>
                            <CardHeader>
                                <CardTitle className="flex items-center gap-2">
                                    <ScanLine className="size-5" />
                                    Detail Jawaban & Skor
                                </CardTitle>
                                <CardDescription>
                                    Berikut rincian jawaban dan poin untuk setiap soal.
                                </CardDescription>
                            </CardHeader>
                            <CardContent className="space-y-6">
                                {(() => {
                                    // eslint-disable-next-line @typescript-eslint/no-unused-vars
                                    const careerQuestions = questions[diagnosisResult.answers.length > 0 ? 0 : 0] ?? [];
                                    const careerId = careers.find(
                                        (c) => c.name === diagnosisResult.career_name,
                                    )?.id;
                                    const qs = careerId
                                        ? (questions[careerId] ?? [])
                                        : [];

                                    if (qs.length === 0) {
                                        return (
                                            <p className="text-sm text-muted-foreground">
                                                Data soal tidak tersedia.
                                            </p>
                                        );
                                    }

                                    const sorted = [...qs].sort((a, b) => a.order - b.order);

                                    return sorted.map((q, idx) => {
                                        const selectedIdx = diagnosisResult.answers[idx];
                                        const selectedOption =
                                            q.options[selectedIdx] ?? null;
                                        const isHigh = selectedOption
                                            ? selectedOption.score >= 2
                                            : false;

                                        return (
                                            <div key={q.id}>
                                                <div className="mb-2 flex items-center justify-between">
                                                    <p className="text-sm font-medium">
                                                        {q.order}. {q.question}
                                                    </p>
                                                    <div
                                                        className={`flex size-8 items-center justify-center rounded-full text-xs font-bold ${
                                                            isHigh
                                                                ? 'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300'
                                                                : 'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300'
                                                        }`}
                                                    >
                        {selectedOption?.score ?? 0}
                                                    </div>
                                                </div>
                                                <div className="grid gap-1.5">
                                                    {q.options.map((opt, oi) => {
                                                        const isSelected = oi === selectedIdx;

                                                        return (
                                                            <div
                                                                key={oi}
                                                                className={`flex items-center gap-3 rounded-lg border px-3 py-2 text-sm ${
                                                                    isSelected
                                                                        ? isHigh
                                                                            ? 'border-green-300 bg-green-50 dark:border-green-700 dark:bg-green-950/20'
                                                                            : 'border-red-300 bg-red-50 dark:border-red-700 dark:bg-red-950/20'
                                                                        : 'border-transparent text-muted-foreground'
                                                                }`}
                                                            >
                                                                <div
                                                                    className={`flex size-5 shrink-0 items-center justify-center rounded-full text-xs font-medium ${
                                                                        isSelected
                                                                            ? 'bg-primary text-primary-foreground'
                                                                            : 'bg-muted'
                                                                    }`}
                                                                >
                                                                    {optionLabels[oi]}
                                                                </div>
                                                                <span className="flex-1">
                                                                    {opt.label}
                                                                </span>
                                                                {isSelected && (
                                                                    <span className="text-xs font-medium text-muted-foreground">
                                                                        +{opt.score} poin
                                                                    </span>
                                                                )}
                                                                {isSelected &&
                                                                    (isHigh ? (
                                                                        <Check className="size-4 shrink-0 text-green-600" />
                                                                    ) : (
                                                                        <X className="size-4 shrink-0 text-red-500" />
                                                                    ))}
                                                            </div>
                                                        );
                                                    })}
                                                </div>
                                            </div>
                                        );
                                    });
                                })()}
                            </CardContent>
                        </Card>

                        {/* Data Pendukung */}
                        {(diagnosisResult.education || diagnosisResult.skills) && (
                            <Card>
                                <CardHeader>
                                    <CardTitle>Data Pendukung</CardTitle>
                                </CardHeader>
                                <CardContent className="space-y-2">
                                    {diagnosisResult.education && (
                                        <div>
                                            <span className="text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                                                Pendidikan
                                            </span>
                                            <p className="text-sm">{diagnosisResult.education}</p>
                                        </div>
                                    )}
                                    {diagnosisResult.skills && (
                                        <div>
                                            <span className="text-xs font-semibold uppercase tracking-wider text-muted-foreground">
                                                Keahlian
                                            </span>
                                            <p className="text-sm">{diagnosisResult.skills}</p>
                                        </div>
                                    )}
                                </CardContent>
                            </Card>
                        )}

                        <div className="flex justify-center gap-4 mb-5">
                            <Button onClick={handleReset} size="lg">
                                Diagnosa Ulang
                                <ScanLine className="ml-2 size-4" />
                            </Button>
                        </div>
                    </div>
                )}
            </div>
        </>
    );
}

Diagnosa.layout = {
    breadcrumbs: [
        {
            title: 'Diagnosa Karir',
            href: diagnosaRoute(),
        },
    ],
};
