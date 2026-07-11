export type User = {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    two_factor_enabled?: boolean;
    phone?: string;
    address?: string;
    bio?: string;
    profession?: string;
    date_of_birth?: string;
    gender?: string;
    website?: string;
    skills?: string[];
    photo?: string;
    created_at: string;
    updated_at: string;
    education?: Education[];
    experiences?: Experience[];
    [key: string]: unknown;
};

export type Auth = {
    user: User;
};

export type Education = {
    id: number;
    user_id: number;
    institution: string;
    degree: string;
    field_of_study: string;
    start_date: string;
    end_date: string | null;
    gpa: number | null;
    description: string | null;
    created_at: string;
    updated_at: string;
};

export type Experience = {
    id: number;
    user_id: number;
    company: string;
    position: string;
    start_date: string;
    end_date: string | null;
    is_current: boolean;
    description: string | null;
    location: string | null;
    created_at: string;
    updated_at: string;
};

/* @chisel-passkeys */
export type Passkey = {
    id: number;
    name: string;
    authenticator: string | null;
    created_at_diff: string;
    last_used_at_diff: string | null;
};
/* @end-chisel-passkeys */

export type TwoFactorSetupData = {
    svg: string;
    url: string;
};

export type TwoFactorSecretKey = {
    secretKey: string;
};
