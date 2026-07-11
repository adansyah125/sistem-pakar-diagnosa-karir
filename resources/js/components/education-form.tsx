import { useForm } from '@inertiajs/react';
import { useState } from 'react';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import {
  Dialog,
  DialogContent,
  DialogDescription,
  DialogFooter,
  DialogHeader,
  DialogTitle,
  DialogTrigger,
} from '@/components/ui/dialog';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';
import type { Education } from '@/types';

const degrees = [
  'SMA / Sederajat',
  'SMK / Sederajat',
  'D3',
  'D4',
  'S1',
  'S2',
  'S3',
];

type Props = {
  education?: Education;
  children: React.ReactNode;
};

export default function EducationForm({ education, children }: Props) {
  const isEditing = !!education;
  const [open, setOpen] = useState(false);

  const { data, setData, post, put, processing, errors, reset } = useForm({
    institution: education?.institution ?? '',
    degree: education?.degree ?? '',
    field_of_study: education?.field_of_study ?? '',
    start_date: education?.start_date ?? '',
    end_date: education?.end_date ?? '',
    gpa: education?.gpa?.toString() ?? '',
    description: education?.description ?? '',
  });

  function handleSubmit(e: React.FormEvent) {
    e.preventDefault();

    setData('gpa', data.gpa ? parseFloat(data.gpa).toString() : '');
    setData('end_date', data.end_date || '');

    if (isEditing) {
      put(`/settings/profile/education/${education.id}`, {
        preserveScroll: true,
        onSuccess: () => {
          setOpen(false);
          reset();
        },
      });
    } else {
      post('/settings/profile/education', {
        preserveScroll: true,
        onSuccess: () => {
          setOpen(false);
          reset();
        },
      });
    }
  }

  return (
    <Dialog open={open} onOpenChange={setOpen}>
      <DialogTrigger asChild>{children}</DialogTrigger>
      <DialogContent className="sm:max-w-[500px]">
        <form onSubmit={handleSubmit}>
          <DialogHeader>
            <DialogTitle>
              {isEditing ? 'Edit Pendidikan' : 'Tambah Pendidikan'}
            </DialogTitle>
            <DialogDescription>
              Isi informasi pendidikan Anda di bawah ini.
            </DialogDescription>
          </DialogHeader>

          <div className="grid gap-4 py-4">
            <div className="grid gap-2">
              <Label htmlFor="institution">Institusi</Label>
              <Input
                id="institution"
                value={data.institution}
                onChange={(e) => setData('institution', e.target.value)}
                required
                placeholder="Nama universitas/sekolah"
              />
              <InputError message={errors.institution} />
            </div>

            <div className="grid grid-cols-2 gap-4">
              <div className="grid gap-2">
                <Label htmlFor="degree">Jenjang</Label>
                <Select
                  value={data.degree}
                  onValueChange={(v) => setData('degree', v)}
                >
                  <SelectTrigger>
                    <SelectValue placeholder="Pilih jenjang" />
                  </SelectTrigger>
                  <SelectContent>
                    {degrees.map((d) => (
                      <SelectItem key={d} value={d}>
                        {d}
                      </SelectItem>
                    ))}
                  </SelectContent>
                </Select>
                <InputError message={errors.degree} />
              </div>

              <div className="grid gap-2">
                <Label htmlFor="field_of_study">Bidang Studi</Label>
                <Input
                  id="field_of_study"
                  value={data.field_of_study}
                  onChange={(e) => setData('field_of_study', e.target.value)}
                  required
                  placeholder="Teknik Informatika"
                />
                <InputError message={errors.field_of_study} />
              </div>
            </div>

            <div className="grid grid-cols-2 gap-4">
              <div className="grid gap-2">
                <Label htmlFor="start_date">Tahun Mulai</Label>
                <Input
                  id="start_date"
                  type="date"
                  value={data.start_date}
                  onChange={(e) => setData('start_date', e.target.value)}
                  required
                />
                <InputError message={errors.start_date} />
              </div>

              <div className="grid gap-2">
                <Label htmlFor="end_date">Tahun Selesai</Label>
                <Input
                  id="end_date"
                  type="date"
                  value={data.end_date}
                  onChange={(e) => setData('end_date', e.target.value)}
                />
                <InputError message={errors.end_date} />
              </div>
            </div>

            <div className="grid gap-2">
              <Label htmlFor="gpa">IPK / Nilai Akhir</Label>
              <Input
                id="gpa"
                type="number"
                step="0.01"
                min="0"
                max="4"
                value={data.gpa}
                onChange={(e) => setData('gpa', e.target.value)}
                placeholder="3.50"
              />
              <InputError message={errors.gpa} />
            </div>

            <div className="grid gap-2">
              <Label htmlFor="description">Deskripsi</Label>
              <textarea
                id="description"
                className="border-input file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground flex min-h-[80px] w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                value={data.description}
                onChange={(e) => setData('description', e.target.value)}
                placeholder="Deskripsi tambahan (opsional)"
              />
              <InputError message={errors.description} />
            </div>
          </div>

          <DialogFooter>
            <Button
              type="button"
              variant="outline"
              onClick={() => {
                setOpen(false);
                reset();
              }}
            >
              Batal
            </Button>
            <Button type="submit" disabled={processing}>
              {isEditing ? 'Simpan' : 'Tambah'}
            </Button>
          </DialogFooter>
        </form>
      </DialogContent>
    </Dialog>
  );
}
