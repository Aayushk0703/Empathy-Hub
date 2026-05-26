import { ArrowUpRight } from "lucide-react";
import { Link } from "react-router-dom";

type FooterLink = {
  label: string;
  to?: string;
  href?: string;
};

const footerLinks: Record<string, FooterLink[]> = {
  Services: [
    { label: "Individual Therapy", to: "/services" },
    { label: "Couples Therapy", to: "/services" },
    { label: "Teen Therapy", to: "/services" },
    { label: "Psychiatric Therapy", to: "/services" },
  ],
  Resources: [
    { label: "Self-Help Tools", to: "/blog" },
    { label: "Privacy Policy", to: "/contact" },
  ],
  Company: [
    { label: "About Us", to: "/about" },
    { label: "For Business", to: "/contact" },
    { label: "Careers", to: "/contact" },
    { label: "Contact", to: "/contact" },
  ],
};

const Footer = () => {
  return (
    <footer className="bg-foreground text-background/80 py-16 px-4">
      <div className="max-w-6xl mx-auto">
        <div className="text-center mb-16">
          <h2 className="font-heading text-3xl md:text-4xl text-background">
            Reclaim your <span className="font-bold">inner harmony</span>
          </h2>
          <Link
            to="/services"
            className="mt-6 inline-flex items-center gap-2 bg-primary text-primary-foreground px-7 py-3.5 rounded-full text-sm font-body hover:opacity-90 transition-opacity"
          >
            Explore Our Services
            <ArrowUpRight size={14} />
          </Link>
        </div>

        <div className="border-t border-background/10 pt-12 grid grid-cols-1 md:grid-cols-4 gap-10">
          <div>
            <div className="flex items-center gap-2 mb-4">
              <div className="w-8 h-8 rounded-full bg-primary flex items-center justify-center">
                <span className="text-primary-foreground font-heading text-sm">E</span>
              </div>
              <span className="font-heading text-lg text-background">Empthy Hub</span>
            </div>
            <p className="text-background/50 font-body text-sm leading-relaxed">
              Personalised and affordable mental health support anytime, anywhere.
            </p>
          </div>

          {Object.entries(footerLinks).map(([category, links]) => (
            <div key={category}>
              <h4 className="font-heading text-background mb-4">{category}</h4>
              <ul className="space-y-2">
                {links.map((link) => (
                  <li key={link.label}>
                    {link.to ? (
                      <Link
                        to={link.to}
                        className="text-background/50 hover:text-background font-body text-sm transition-colors"
                      >
                        {link.label}
                      </Link>
                    ) : (
                      <a
                        href={link.href}
                        className="text-background/50 hover:text-background font-body text-sm transition-colors"
                      >
                        {link.label}
                      </a>
                    )}
                  </li>
                ))}
              </ul>
            </div>
          ))}

          <div>
            <h4 className="font-heading text-background mb-4">Support</h4>
            <ul className="space-y-2">
              <li>
                <Link
                  to="/faq"
                  className="text-background/50 hover:text-background font-body text-sm transition-colors"
                >
                  FAQs
                </Link>
              </li>
              <li>
                <Link
                  to="/blog"
                  className="text-background/50 hover:text-background font-body text-sm transition-colors"
                >
                  Blogs
                </Link>
              </li>
            </ul>
          </div>
        </div>

        <div className="border-t border-background/10 mt-12 pt-8 text-center">
          <p className="text-background/40 font-body text-sm">
            © 2026 Empthy Hub. All rights reserved.
          </p>
        </div>
      </div>
    </footer>
  );
};

export default Footer;
