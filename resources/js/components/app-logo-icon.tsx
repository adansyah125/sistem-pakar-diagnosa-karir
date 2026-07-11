import type { SVGAttributes } from 'react';

export default function AppLogoIcon(props: SVGAttributes<SVGElement>) {
    return (
        <svg 
            {...props} 
            viewBox="0 0 24 24" 
            fill="none" 
            stroke="currentColor" 
            strokeWidth="2" 
            strokeLinecap="round" 
            strokeLinejoin="round" 
            xmlns="http://www.w3.org/2000/svg"
        >
            {/* Grafik Pertumbuhan */}
            <path d="m3 16 4-4 4 4 7-7" />
            <path d="M14 9h4v4" />
            {/* Lantai/Garis Dasar */}
            <path d="M3 21h18" />
        </svg>
    );
}