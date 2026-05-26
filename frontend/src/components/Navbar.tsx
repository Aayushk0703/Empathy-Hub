import { useState } from "react";
import { Link } from "react-router-dom";
import { Menu, X, ArrowUpRight, User } from "lucide-react";
import { motion, AnimatePresence } from "framer-motion";

const navLinks = [
  { label: "Home", href: "/", isRoute: true },
  { label: "Services", href: "/services", isRoute: true },
  { label: "About", href: "/about", isRoute: true },
  { label: "Testimonials", href: "/testimonials", isRoute: true },
  { label: "Contact", href: "/contact", isRoute: true },
  { label: "Book Session", href: "/book-session", isRoute: true },
];

const Navbar = () => {
  const [isOpen, setIsOpen] = useState(false);

  return (
    <nav className="fixed top-4 left-1/2 -translate-x-1/2 z-50 w-[95%] max-w-6xl">
      <div className="bg-card/80 backdrop-blur-lg rounded-full px-6 py-3 flex items-center justify-between border border-border shadow-sm">
<a href="/" className="flex items-center gap-2">
          <img
            src="/app/logo.jpeg"
            alt="Logo"
            className="w-16 h-12 rounded-full object-cover"
          />
        </a>

        <div className="hidden lg:flex items-center gap-8">
          {navLinks.map((link) =>
            link.isRoute ? (
              <Link
                key={link.label}
                to={link.href}
                className="text-sm text-muted-foreground hover:text-foreground transition-colors font-body"
              >
                {link.label}
              </Link>
            ) : (
              <a
                key={link.label}
                href={link.href}
                className="text-sm text-muted-foreground hover:text-foreground transition-colors font-body"
              >
                {link.label}
              </a>
            ),
          )}
        </div>

        <div className="flex items-center gap-3">
          <Link
            to="/login"
            className="hidden sm:flex items-center gap-2 text-sm text-muted-foreground hover:text-foreground transition-colors font-body"
          >
            <User size={16} />
            Login
          </Link>
          <Link
            to="/book-session"
            className="hidden sm:flex items-center gap-2 bg-foreground text-background px-5 py-2.5 rounded-full text-sm font-body hover:opacity-90 transition-opacity"
          >
            Book Session
            <ArrowUpRight size={14} />
          </Link>
          <button
            onClick={() => setIsOpen(!isOpen)}
            className="lg:hidden p-2 text-foreground"
          >
            {isOpen ? <X size={20} /> : <Menu size={20} />}
          </button>
        </div>
      </div>

      <AnimatePresence>
        {isOpen && (
          <motion.div
            initial={{ opacity: 0, y: -10 }}
            animate={{ opacity: 1, y: 0 }}
            exit={{ opacity: 0, y: -10 }}
            className="lg:hidden mt-2 bg-card/95 backdrop-blur-lg rounded-2xl px-6 py-4 border border-border shadow-lg"
          >
            {navLinks.map((link) =>
              link.isRoute ? (
                <Link
                  key={link.label}
                  to={link.href}
                  className="block py-3 text-muted-foreground hover:text-foreground transition-colors font-body border-b border-border last:border-0"
                  onClick={() => setIsOpen(false)}
                >
                  {link.label}
                </Link>
              ) : (
                <a
                  key={link.label}
                  href={link.href}
                  className="block py-3 text-muted-foreground hover:text-foreground transition-colors font-body border-b border-border last:border-0"
                  onClick={() => setIsOpen(false)}
                >
                  {link.label}
                </a>
              ),
            )}
            <Link
              to="/login"
              className="block py-3 text-muted-foreground hover:text-foreground transition-colors font-body border-b border-border"
              onClick={() => setIsOpen(false)}
            >
              Login
            </Link>
            <Link
              to="/book-session"
              className="mt-3 flex items-center justify-center gap-2 bg-foreground text-background px-5 py-2.5 rounded-full text-sm font-body"
              onClick={() => setIsOpen(false)}
            >
              Book Session
              <ArrowUpRight size={14} />
            </Link>
          </motion.div>
        )}
      </AnimatePresence>
    </nav>
  );
};

export default Navbar;
