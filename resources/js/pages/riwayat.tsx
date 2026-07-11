/* eslint-disable @stylistic/brace-style */
/* eslint-disable curly */
import { Head, Link, router } from '@inertiajs/react';
import { useState } from 'react';
// eslint-disable-next-line import/order
import {
    Eye,
    History,
    ScanLine,
    Search,
    ChevronLeft,
    ChevronRight,
    Trash2,
    
} from 'lucide-react';
import { Button } from '@/components/ui/button';
import {
    Card,
    CardContent,
    CardDescription,
    CardHeader,
    CardTitle,
} from '@/components/ui/card';
import {
    Dialog,
    DialogContent,
    DialogHeader,
    DialogTitle,
    DialogDescription,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { diagnosa } from '@/routes';
import { riwayat as riwayatRoute } from '@/routes';

type AnswerDetail = {
    question: string;
    score: number;
    max_score: number;
    option_label: string;
};

type ResultItem = {
    id: number;
    career_id: number;
    career_name: string;
    education: string | null;
    skills: string | null;
    total_score: number;
    max_score: number;
    percentage: number;
    conclusion: string;
    created_at: string;
    answers_detail: AnswerDetail[];
};

type Pagination = {
    current_page: number;
    last_page: number;
    per_page: number;
    total: number;
    has_more_pages: boolean;
};

export default function Riwayat({
    results = [],
    pagination = { current_page: 1, last_page: 1, per_page: 6, total: 0, has_more_pages: false },
    search = '',
}: {
    results: ResultItem[];
    pagination: Pagination;
    search: string;
}) {
    const [detailItem, setDetailItem] = useState<ResultItem | null>(null);
    const [deleteId, setDeleteId] = useState<number | null>(null);

    function getConclusionColor(conclusion: string): string {
        if (conclusion === 'Sangat Sesuai') return 'text-green-600';

        if (conclusion === 'Sesuai') return 'text-blue-600';

        if (conclusion === 'Cukup Sesuai') return 'text-yellow-600';

        return 'text-red-600';
    }

    function getConclusionBg(conclusion: string): string {
        if (conclusion === 'Sangat Sesuai') return 'bg-green-100 dark:bg-green-900/30';

        if (conclusion === 'Sesuai') return 'bg-blue-100 dark:bg-blue-900/30';

        if (conclusion === 'Cukup Sesuai') return 'bg-yellow-100 dark:bg-yellow-900/30';

        return 'bg-red-100 dark:bg-red-900/30';
    }

    function handleSearch(value: string) {
        router.get(
            '/riwayat',
            { search: value || null },
            { preserveState: true, preserveScroll: true, replace: true },
        );
    }

    function goToPage(page: number) {
        router.get(
            '/riwayat',
            { search: search || null, page },
            { preserveState: true, preserveScroll: true, replace: true },
        );
    }

    function confirmDelete(id: number) {
        router.delete(`/riwayat/${id}`, {
            preserveState: true,
            preserveScroll: true,
            replace: true,
            onSuccess: () => setDeleteId(null),
        });
    }

    function getScoreBg(score: number): string {
        if (score === 3) return 'bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-400';

        if (score === 2) return 'bg-blue-100 text-blue-700 dark:bg-blue-900/40 dark:text-blue-400';

        if (score === 1) return 'bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-400';

        return 'bg-red-100 text-red-700 dark:bg-red-900/40 dark:text-red-400';
    }

    return (
        <>
            <Head title="Riwayat Diagnosa" />

            <div className="flex flex-col gap-6 p-4">

                {/* Search */}
                <div className="relative max-w-sm">
                    <Search className="absolute top-1/2 left-3 size-4 -translate-y-1/2 text-muted-foreground" />
                    <Input
                        placeholder="Cari bidang karir..."
                        defaultValue={search}
                        onChange={(e) => handleSearch(e.target.value)}
                        className="pl-9"
                    />
                </div>

                {/* Empty State */}
                {results.length === 0 && !search && (
                    <Card>
                        <CardContent className="flex flex-col items-center gap-4 py-12">
                            <History className="size-12 text-muted-foreground/50" />
                            <div className="text-center">
                                <p className="font-medium">Belum ada riwayat diagnosa</p>
                                <p className="mt-1 text-sm text-muted-foreground">
                                    Lakukan diagnosa karir terlebih dahulu untuk melihat hasilnya.
                                </p>
                            </div>
                            <Link
                                href={diagnosa()}
                                className="inline-flex items-center gap-2 rounded-lg bg-primary px-4 py-2 text-sm font-medium text-primary-foreground hover:bg-primary/90"
                            >
                                <ScanLine className="size-4" />
                                Mulai Diagnosa
                            </Link>
                        </CardContent>
                    </Card>
                )}

                {/* Empty search result */}
                {results.length === 0 && search && (
                    <Card>
                        <CardContent className="flex flex-col items-center gap-4 py-12">
                            <Search className="size-12 text-muted-foreground/50" />
                            <div className="text-center">
                                <p className="font-medium">Tidak ditemukan</p>
                                <p className="mt-1 text-sm text-muted-foreground">
                                    Tidak ada hasil diagnosa untuk pencarian "{search}".
                                </p>
                            </div>
                        </CardContent>
                    </Card>
                )}

                {/* Results */}
                {results.length > 0 && (
                    <div className="grid gap-4">
                        {results.map((r) => (
                            <Card key={r.id}>
                                <CardHeader className="pb-3">
                                    <div className="flex items-start justify-between">
                                        <div>
                                            <CardTitle className="text-base">
                                                {r.career_name}
                                            </CardTitle>
                                            <CardDescription>{r.created_at}</CardDescription>
                                        </div>
                                        <div
                                            className={`rounded-full px-3 py-1 text-xs font-semibold ${getConclusionBg(r.conclusion)} ${getConclusionColor(r.conclusion)}`}
                                        >
                                            {r.conclusion}
                                        </div>
                                    </div>
                                </CardHeader>
                                <CardContent>
                                    <div className="flex flex-wrap gap-6">
                                        <div>
                                            <span className="text-xs text-muted-foreground">Skor</span>
                                            <p className="text-lg font-bold">
                                                {r.total_score}
                                                <span className="text-sm font-normal text-muted-foreground">
                                                    /{r.max_score}
                                                </span>
                                            </p>
                                        </div>
                                        <div className="flex-1">
                                            <span className="text-xs text-muted-foreground">
                                                Tingkat Kesesuaian
                                            </span>
                                            <div className="mt-1 flex items-center gap-2">
                                                <div className="h-2 flex-1 rounded-full bg-muted">
                                                    <div
                                                        className="h-2 rounded-full bg-primary"
                                                        style={{ width: `${r.percentage}%` }}
                                                    />
                                                </div>
                                                <span className="text-xs font-medium">
                                                    {r.percentage}%
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    {r.education && (
                                        <p className="mt-2 text-xs text-muted-foreground">
                                            Pendidikan: {r.education}
                                        </p>
                                    )}
                                    <div className="mt-3 flex gap-2">
                                        <Button
                                            variant="outline"
                                            size="sm"
                                            onClick={() => setDetailItem(r)}
                                        >
                                            <Eye className="mr-1 size-3.5" />
                                            Lihat Hasil
                                        </Button>
                                        <Button
                                            variant="destructive"
                                            size="sm"
                                            onClick={() => setDeleteId(r.id)}
                                        >
                                            <Trash2 className="mr-1 size-3.5" />
                                            Hapus
                                        </Button>
                                    </div>
                                </CardContent>
                            </Card>
                        ))}
                    </div>
                )}

                {/* Pagination */}
                {results.length > 0 && pagination.last_page > 1 && (
                    <div className="flex items-center justify-center gap-2">
                        <Button
                            variant="outline"
                            size="sm"
                            disabled={pagination.current_page <= 1}
                            onClick={() => goToPage(pagination.current_page - 1)}
                        >
                            <ChevronLeft className="size-4" />
                        </Button>

                        {Array.from({ length: pagination.last_page }, (_, i) => i + 1).map((page) => (
                            <Button
                                key={page}
                                variant={page === pagination.current_page ? 'default' : 'outline'}
                                size="sm"
                                onClick={() => goToPage(page)}
                            >
                                {page}
                            </Button>
                        ))}

                        <Button
                            variant="outline"
                            size="sm"
                            disabled={!pagination.has_more_pages}
                            onClick={() => goToPage(pagination.current_page + 1)}
                        >
                            <ChevronRight className="size-4" />
                        </Button>
                    </div>
                )}
            </div>

            {/* Detail Dialog */}
            <Dialog open={detailItem !== null} onOpenChange={(open) => { if (!open) setDetailItem(null); }}>
                <DialogContent className="max-h-[85vh] overflow-y-auto sm:max-w-lg">
                    <DialogHeader>
                        <DialogTitle>Hasil Diagnosa</DialogTitle>
                        <DialogDescription>
                            {detailItem?.career_name} &middot; {detailItem?.created_at}
                        </DialogDescription>
                    </DialogHeader>

                    {detailItem && (
                        <div className="space-y-6">
                            {/* Score Summary */}
                            <div className="flex items-center justify-between rounded-lg bg-muted p-4">
                                <div>
                                    <p className="text-sm text-muted-foreground">Total Skor</p>
                                    <p className="text-2xl font-bold">
                                        {detailItem.total_score}
                                        <span className="text-sm font-normal text-muted-foreground">
                                            /{detailItem.max_score}
                                        </span>
                                    </p>
                                </div>
                                <div className="text-right">
                                    <p className="text-sm text-muted-foreground">Tingkat Kesesuaian</p>
                                    <p className={`text-lg font-semibold ${getConclusionColor(detailItem.conclusion)}`}>
                                        {detailItem.conclusion}
                                    </p>
                                </div>
                            </div>

                            {detailItem.education && (
                                <p className="text-sm">
                                    <span className="text-muted-foreground">Pendidikan:</span> {detailItem.education}
                                </p>
                            )}

                            {/* Answers Breakdown */}
                            <div className="space-y-3">
                                <h4 className="text-sm font-semibold">Detail Jawaban</h4>
                                {detailItem.answers_detail.map((a, i) => (
                                    <div key={i} className="rounded-lg border p-3">
                                        <p className="text-sm font-medium">
                                            {i + 1}. {a.question}
                                        </p>
                                        <div className="mt-2 flex items-center justify-between">
                                            <span className="text-xs text-muted-foreground">
                                                {a.option_label}
                                            </span>
                                            <span
                                                className={`inline-flex items-center rounded-full px-2 py-0.5 text-xs font-semibold ${getScoreBg(a.score)}`}
                                            >
                                                {a.score}/{a.max_score}
                                            </span>
                                        </div>
                                    </div>
                                ))}
                            </div>
                        </div>
                    )}
                </DialogContent>
            </Dialog>

            {/* Delete Confirmation Dialog */}
            <Dialog open={deleteId !== null} onOpenChange={(open) => { if (!open) setDeleteId(null); }}>
                <DialogContent className="sm:max-w-sm">
                    <DialogHeader>
                        <DialogTitle>Hapus Riwayat</DialogTitle>
                        <DialogDescription>
                            Apakah Anda yakin ingin menghapus hasil diagnosa ini? Tindakan ini tidak dapat dibatalkan.
                        </DialogDescription>
                    </DialogHeader>
                    <div className="flex justify-end gap-2">
                        <Button variant="outline" onClick={() => setDeleteId(null)}>
                            Batal
                        </Button>
                        <Button
                            variant="destructive"
                            onClick={() => deleteId !== null && confirmDelete(deleteId)}
                        >
                            Hapus
                        </Button>
                    </div>
                </DialogContent>
            </Dialog>
        </>
    );
}

Riwayat.layout = {
    breadcrumbs: [
        {
            title: 'Riwayat Diagnosa',
            href: riwayatRoute(),
        },
    ],
};
