import { Form, Head, Link, router, usePage } from '@inertiajs/react';
import ProfileController from '@/actions/App/Http/Controllers/Settings/ProfileController';
import DeleteUser from '@/components/delete-user';
import EducationForm from '@/components/education-form';
import ExperienceForm from '@/components/experience-form';
import Heading from '@/components/heading';
import InputError from '@/components/input-error';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import {
  Select,
  SelectContent,
  SelectItem,
  SelectTrigger,
  SelectValue,
} from '@/components/ui/select';
import { Separator } from '@/components/ui/separator';
import { edit } from '@/routes/profile';
import { send } from '@/routes/verification';
import type { Auth, Education, Experience } from '@/types';

type PageProps = {
  auth: Auth;
  education: Education[];
  experiences: Experience[];
};

export default function Profile({
  mustVerifyEmail,
  status,
  education = [],
  experiences = [],
}: {
  mustVerifyEmail: boolean;
  status?: string;
  education: Education[];
  experiences: Experience[];
}) {
  const { auth } = usePage<PageProps>().props;

  function handleDelete(type: 'education' | 'experience', id: number) {
    if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
      router.delete(`/settings/profile/${type}/${id}`, {
        preserveScroll: true,
      });
    }
  }

  function formatDate(date: string | null) {
    if (!date) return 'Sekarang';
    return new Date(date).toLocaleDateString('id-ID', {
      year: 'numeric',
      month: 'long',
    });
  }

  return (
    <>
      <Head title="Profile settings" />

      <h1 className="sr-only">Profile settings</h1>

      <div className="space-y-10">
        {/* ============ DATA PRIBADI ============ */}
        <section>
          <Heading
            variant="small"
            title="Data Pribadi"
            description="Informasi diri dan kontak Anda"
          />

          <Form
            {...ProfileController.update.form()}
            options={{
              preserveScroll: true,
            }}
            className="mt-6 space-y-6"
          >
            {({ processing, errors }) => (
              <>
                <div className="grid gap-4 sm:grid-cols-2">
                  <div className="grid gap-2">
                    <Label htmlFor="name">Nama Lengkap</Label>
                    <Input
                      id="name"
                      defaultValue={auth.user.name}
                      name="name"
                      required
                      autoComplete="name"
                      placeholder="Nama lengkap"
                    />
                    <InputError message={errors.name} />
                  </div>

                  <div className="grid gap-2">
                    <Label htmlFor="email">Email</Label>
                    <Input
                      id="email"
                      type="email"
                      defaultValue={auth.user.email}
                      name="email"
                      required
                      autoComplete="username"
                      placeholder="Email address"
                    />
                    <InputError message={errors.email} />
                  </div>

                  <div className="grid gap-2">
                    <Label htmlFor="phone">No. Telepon</Label>
                    <Input
                      id="phone"
                      type="tel"
                      defaultValue={auth.user.phone}
                      name="phone"
                      placeholder="0812-3456-7890"
                    />
                    <InputError message={errors.phone} />
                  </div>

                  <div className="grid gap-2">
                    <Label htmlFor="profession">Profesi</Label>
                    <Input
                      id="profession"
                      defaultValue={auth.user.profession}
                      name="profession"
                      placeholder="Software Engineer"
                    />
                    <InputError message={errors.profession} />
                  </div>

                  <div className="grid gap-2">
                    <Label htmlFor="date_of_birth">Tanggal Lahir</Label>
                    <Input
                      id="date_of_birth"
                      type="date"
                      defaultValue={auth.user.date_of_birth}
                      name="date_of_birth"
                    />
                    <InputError message={errors.date_of_birth} />
                  </div>

                  <div className="grid gap-2">
                    <Label htmlFor="gender">Jenis Kelamin</Label>
                    <Select
                      defaultValue={auth.user.gender || ''}
                      onValueChange={(value) => {
                        const input = document.getElementById(
                          'gender-hidden',
                        ) as HTMLInputElement;
                        if (input) input.value = value;
                      }}
                    >
                      <SelectTrigger>
                        <SelectValue placeholder="Pilih jenis kelamin" />
                      </SelectTrigger>
                      <SelectContent>
                        <SelectItem value="Laki-laki">Laki-laki</SelectItem>
                        <SelectItem value="Perempuan">Perempuan</SelectItem>
                      </SelectContent>
                    </Select>
                    <input id="gender-hidden" type="hidden" name="gender" defaultValue={auth.user.gender || ''} />
                    <InputError message={errors.gender} />
                  </div>

                  <div className="grid gap-2">
                    <Label htmlFor="website">Website / Portfolio</Label>
                    <Input
                      id="website"
                      type="url"
                      defaultValue={auth.user.website}
                      name="website"
                      placeholder="https://example.com"
                    />
                    <InputError message={errors.website} />
                  </div>

                  <div className="grid gap-2">
                    <Label htmlFor="skills">Skills (dipisah koma)</Label>
                    <Input
                      id="skills"
                      defaultValue={auth.user.skills?.join(', ') || ''}
                      name="skills"
                      placeholder="PHP, Laravel, React, JavaScript"
                    />
                    <InputError message={errors.skills} />
                  </div>
                </div>

                <div className="grid gap-2">
                  <Label htmlFor="address">Alamat</Label>
                  <textarea
                    id="address"
                    name="address"
                    className="border-input file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground flex min-h-[80px] w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                    defaultValue={auth.user.address}
                    placeholder="Alamat lengkap"
                  />
                  <InputError message={errors.address} />
                </div>

                <div className="grid gap-2">
                  <Label htmlFor="bio">Bio / Tentang Saya</Label>
                  <textarea
                    id="bio"
                    name="bio"
                    className="border-input file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground flex min-h-[100px] w-full rounded-md border bg-transparent px-3 py-2 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm"
                    defaultValue={auth.user.bio}
                    placeholder="Ceritakan tentang diri Anda"
                  />
                  <InputError message={errors.bio} />
                </div>

                {mustVerifyEmail && auth.user.email_verified_at === null && (
                  <div>
                    <p className="-mt-4 text-sm text-muted-foreground">
                      Your email address is unverified.{' '}
                      <Link
                        href={send()}
                        as="button"
                        className="text-foreground underline decoration-neutral-300 underline-offset-4 transition-colors duration-300 ease-out hover:decoration-current! dark:decoration-neutral-500"
                      >
                        Click here to re-send the verification email.
                      </Link>
                    </p>

                    {status === 'verification-link-sent' && (
                      <div className="mt-2 text-sm font-medium text-green-600">
                        A new verification link has been sent to your email
                        address.
                      </div>
                    )}
                  </div>
                )}

                <div className="flex items-center gap-4">
                  <Button disabled={processing} data-test="update-profile-button">
                    Simpan
                  </Button>
                </div>
              </>
            )}
          </Form>
        </section>

        <Separator />

        {/* ============ PENDIDIKAN ============ */}
        <section>
          <div className="flex items-center justify-between">
            <Heading
              variant="small"
              title="Pendidikan"
              description="Riwayat pendidikan formal Anda"
            />
            <EducationForm>
              <Button variant="outline" size="sm">
                + Tambah
              </Button>
            </EducationForm>
          </div>

          <div className="mt-6 space-y-4">
            {education.length === 0 ? (
              <p className="text-sm text-muted-foreground">
                Belum ada data pendidikan. Klik "Tambah" untuk menambahkan.
              </p>
            ) : (
              education.map((edu) => (
                <div
                  key={edu.id}
                  className="flex items-start justify-between rounded-lg border p-4"
                >
                  <div className="space-y-1">
                    <h4 className="font-medium">{edu.institution}</h4>
                    <p className="text-sm text-muted-foreground">
                      {edu.degree} - {edu.field_of_study}
                    </p>
                    <p className="text-xs text-muted-foreground">
                      {formatDate(edu.start_date)} -{' '}
                      {formatDate(edu.end_date)}
                      {edu.gpa ? ` | IPK: ${edu.gpa}` : ''}
                    </p>
                    {edu.description && (
                      <p className="mt-1 text-sm">{edu.description}</p>
                    )}
                  </div>
                  <div className="flex gap-2">
                    <EducationForm education={edu}>
                      <Button variant="ghost" size="sm">
                        Edit
                      </Button>
                    </EducationForm>
                    <Button
                      variant="ghost"
                      size="sm"
                      className="text-destructive"
                      onClick={() => handleDelete('education', edu.id)}
                    >
                      Hapus
                    </Button>
                  </div>
                </div>
              ))
            )}
          </div>
        </section>

        <Separator />

        {/* ============ PENGALAMAN ============ */}
        <section>
          <div className="flex items-center justify-between">
            <Heading
              variant="small"
              title="Pengalaman"
              description="Riwayat pekerjaan dan pengalaman profesional Anda"
            />
            <ExperienceForm>
              <Button variant="outline" size="sm">
                + Tambah
              </Button>
            </ExperienceForm>
          </div>

          <div className="mt-6 space-y-4">
            {experiences.length === 0 ? (
              <p className="text-sm text-muted-foreground">
                Belum ada data pengalaman. Klik "Tambah" untuk menambahkan.
              </p>
            ) : (
              experiences.map((exp) => (
                <div
                  key={exp.id}
                  className="flex items-start justify-between rounded-lg border p-4"
                >
                  <div className="space-y-1">
                    <h4 className="font-medium">{exp.position}</h4>
                    <p className="text-sm text-muted-foreground">
                      {exp.company}
                      {exp.location ? ` - ${exp.location}` : ''}
                    </p>
                    <p className="text-xs text-muted-foreground">
                      {formatDate(exp.start_date)} -{' '}
                      {formatDate(exp.end_date)}
                      {exp.is_current ? ' (Saat ini)' : ''}
                    </p>
                    {exp.description && (
                      <p className="mt-1 text-sm">{exp.description}</p>
                    )}
                  </div>
                  <div className="flex gap-2">
                    <ExperienceForm experience={exp}>
                      <Button variant="ghost" size="sm">
                        Edit
                      </Button>
                    </ExperienceForm>
                    <Button
                      variant="ghost"
                      size="sm"
                      className="text-destructive"
                      onClick={() => handleDelete('experience', exp.id)}
                    >
                      Hapus
                    </Button>
                  </div>
                </div>
              ))
            )}
          </div>
        </section>

        <Separator />

        <DeleteUser />
      </div>
    </>
  );
}

Profile.layout = {
  breadcrumbs: [
    {
      title: 'Profile settings',
      href: edit(),
    },
  ],
};
