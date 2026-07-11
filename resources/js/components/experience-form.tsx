import { useForm } from '@inertiajs/react';
import { useState } from 'react';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
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
import type { Experience } from '@/types';

type Props = {
  experience?: Experience;
  children: React.ReactNode;
};

export default function ExperienceForm({ experience, children }: Props) {
  const isEditing = !!experience;
  const [open, setOpen] = useState(false);

  const { data, setData, post, put, processing, errors, reset } = useForm({
    company: experience?.company ?? '',
    position: experience?.position ?? '',
    start_date: experience?.start_date ?? '',
    end_date: experience?.end_date ?? '',
    is_current: experience?.is_current ?? false,
    description: experience?.description ?? '',
    location: experience?.location ?? '',
  });

  function handleSubmit(e: React.FormEvent) {
    e.preventDefault();

    if (data.is_current) {
      setData('end_date', '');
    }

    if (isEditing) {
      put(`/settings/profile/experience/${experience.id}`, {
        preserveScroll: true,
        onSuccess: () => {
          setOpen(false);
          reset();
        },
      });
    } else {
      post('/settings/profile/experience', {
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
              {isEditing ? 'Edit Pengalaman' : 'Tambah Pengalaman'}
            </DialogTitle>
            <DialogDescription>
              Isi informasi pengalaman kerja Anda.
            </DialogDescription>
          </DialogHeader>

          <div className="grid gap-4 py-4">
            <div className="grid gap-2">
              <Label htmlFor="company">Perusahaan</Label>
              <Input
                id="company"
                value={data.company}
                onChange={(e) => setData('company', e.target.value)}
                required
                placeholder="Nama perusahaan"
              />
              <InputError message={errors.company} />
            </div>

            <div className="grid grid-cols-2 gap-4">
              <div className="grid gap-2">
                <Label htmlFor="position">Posisi</Label>
                <Input
                  id="position"
                  value={data.position}
                  onChange={(e) => setData('position', e.target.value)}
                  required
                  placeholder="Software Engineer"
                />
                <InputError message={errors.position} />
              </div>

              <div className="grid gap-2">
                <Label htmlFor="location">Lokasi</Label>
                <Input
                  id="location"
                  value={data.location}
                  onChange={(e) => setData('location', e.target.value)}
                  placeholder="Bandung"
                />
                <InputError message={errors.location} />
              </div>
            </div>

            <div className="grid grid-cols-2 gap-4">
              <div className="grid gap-2">
                <Label htmlFor="start_date">Tanggal Mulai</Label>
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
                <Label htmlFor="end_date">Tanggal Selesai</Label>
                <Input
                  id="end_date"
                  type="date"
                  value={data.end_date}
                  onChange={(e) => setData('end_date', e.target.value)}
                  disabled={data.is_current}
                />
                <InputError message={errors.end_date} />
              </div>
            </div>

            <div className="flex items-center gap-2">
              <Checkbox
                id="is_current"
                checked={data.is_current}
                onCheckedChange={(checked) => {
                  setData('is_current', checked === true);
                  if (checked) {
                    setData('end_date', '');
                  }
                }}
              />
              <Label htmlFor="is_current" className="text-sm font-normal">
                Saya masih bekerja di sini
              </Label>
            </div>

            <div className="grid gap-2">
              <Label htmlFor="description">Deskripsi</Label>
              <textarea
                id="description"
                className="border-input file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground flex min-h-[100px] w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                value={data.description}
                onChange={(e) => setData('description', e.target.value)}
                placeholder="Deskripsikan tanggung jawab dan pencapaian Anda"
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
