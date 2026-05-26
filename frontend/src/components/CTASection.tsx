import { ArrowUpRight } from "lucide-react";
import { motion } from "framer-motion";
import ctaImage from "@/assets/cta-image.jpg";

const CTASection = () => {
  return (
    <section className="py-20 px-4">
      <div className="max-w-6xl mx-auto">
        {/* Strength CTA */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="rounded-3xl overflow-hidden relative h-80 md:h-96 flex items-center justify-center text-center"
        >
<img
            src={ctaImage}
            alt="Find strength in your story"
            className="absolute inset-0 w-full h-full object-cover"
            loading="eager"
            width={1920}
            height={1080}
          />
          <div className="absolute inset-0 bg-foreground/50" />
          <div className="relative z-10">
            <h2 className="font-heading text-3xl md:text-5xl text-background">
              Let's find <span className="font-bold">Strength</span> in your story
            </h2>
            <a
              href="#services"
              className="mt-8 inline-flex items-center gap-2 bg-background text-foreground px-7 py-3.5 rounded-full text-sm font-body hover:opacity-90 transition-opacity"
            >
              Explore Our Services
              <ArrowUpRight size={14} />
            </a>
          </div>
        </motion.div>

        {/* Healing Section */}
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          className="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8 items-center"
        >
          <div>
            <p className="text-muted-foreground font-body text-lg">Your healing</p>
            <h2 className="font-heading text-3xl md:text-4xl text-foreground mt-1">
              Is <span className="font-bold">Our Responsibility</span>
            </h2>
            <ul className="mt-8 space-y-4 font-body text-foreground">
              {[
                "Trusted therapists at your service",
                "Flexible chat, call, video sessions",
                "Affordable pricing plans",
                "Safe space for you",
              ].map((item) => (
                <li key={item} className="flex items-center gap-3">
                  <span className="w-2 h-2 rounded-full bg-primary" />
                  {item}
                </li>
              ))}
            </ul>
            <a
              href="#services"
              className="mt-8 inline-flex items-center gap-2 bg-primary text-primary-foreground px-7 py-3.5 rounded-full text-sm font-body hover:opacity-90 transition-opacity"
            >
              Explore Our Services
              <ArrowUpRight size={14} />
            </a>
          </div>
          <div className="rounded-2xl overflow-hidden h-72 md:h-96 bg-secondary">
<img
              src={ctaImage}
              alt="Your healing journey"
              className="w-full h-full object-cover"
              loading="eager"
              width={1920}
              height={1080}
            />
          </div>
        </motion.div>
      </div>
    </section>
  );
};

export default CTASection;
