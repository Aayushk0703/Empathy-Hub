import { ArrowUpRight } from "lucide-react";
import { motion } from "framer-motion";
import heroImage from "@/assets/hero-image.jpg";

const HeroSection = () => {
  return (
    <section className="min-h-screen flex flex-col items-center justify-center text-center px-4 pt-24 pb-8">
      <motion.div
        initial={{ opacity: 0, y: 30 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.8 }}
        className="max-w-3xl mx-auto"
      >
        <h1 className="text-4xl md:text-6xl lg:text-7xl font-heading text-foreground leading-tight">
          Feel heard, Supported, free
        </h1>
        <p className="mt-6 text-muted-foreground text-lg md:text-xl max-w-xl mx-auto font-body leading-relaxed">
          We connect you with certified therapists, offering personalised and affordable mental health support anytime, anywhere.
        </p>
        <motion.a
          href="#services"
          whileHover={{ scale: 1.05 }}
          whileTap={{ scale: 0.95 }}
          className="mt-10 inline-flex items-center gap-2 bg-primary/15 text-foreground px-7 py-3.5 rounded-full text-sm font-body border border-primary/30 hover:bg-primary/25 transition-colors"
        >
          Explore Our Services
          <span className="w-7 h-7 rounded-full bg-primary flex items-center justify-center">
            <ArrowUpRight size={14} className="text-primary-foreground" />
          </span>
        </motion.a>
      </motion.div>

      <motion.div
        initial={{ opacity: 0, y: 40 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.8, delay: 0.3 }}
        className="mt-16 w-full max-w-5xl grid grid-cols-1 md:grid-cols-2 gap-4"
      >
        <div className="rounded-2xl overflow-hidden h-72 md:h-96">
<img
            src={heroImage}
            alt="Peaceful nature scene representing mental wellness"
            className="w-full h-full object-cover"
            width={800}
            height={1067}
loading="eager"
          />
        </div>
        <div className="rounded-2xl bg-secondary/60 p-8 md:p-12 flex flex-col justify-center">
          <p className="text-muted-foreground font-body text-lg">Just a few steps to</p>
          <p className="font-heading text-3xl md:text-4xl text-foreground mt-1">
            <span className="font-bold">Relief</span>
          </p>
          <div className="mt-8 space-y-4">
            {[
              { num: "1", text: "Choose your plan" },
              { num: "2", text: "Take a short assessment" },
              { num: "3", text: "Talk with a therapist" },
            ].map((step) => (
              <div key={step.num} className="flex items-center gap-4">
                <span className="w-10 h-10 rounded-full bg-primary/15 text-primary flex items-center justify-center font-heading text-lg">
                  {step.num}
                </span>
                <span className="text-foreground font-body">{step.text}</span>
              </div>
            ))}
          </div>
        </div>
      </motion.div>
    </section>
  );
};

export default HeroSection;
