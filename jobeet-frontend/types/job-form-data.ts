export type JobFormData = {
    category_id: string;
    type: string;
    company: string;
    url: string;
    logo: File | null;
    position: string;
    location: string;
    email: string;
    description: string;
    how_to_apply: string;
    is_public: boolean;
};