import { useState } from "react";
import Navbar from "@/components/Navbar";
import Footer from "@/components/Footer";
import { Phone, MessageCircle } from "lucide-react";
import { motion, AnimatePresence } from "framer-motion";
import { ChevronDown } from "lucide-react";

interface FAQItem {
  question: string;
  answer: string;
}

const faqData: FAQItem[] = [
  {
    question: "Do I really need therapy?",
    answer: "If something is affecting your peace, it matters enough."
  },
  {
    question: "Will I be judged?",
    answer: "No. Therapy is a safe, non-judgmental space for you."
  },
  {
    question: "How do I open up to a stranger?",
    answer: "You don't have to rush, your pace, your comfort."
  },
  {
    question: "Is therapy only for serious issues?",
    answer: "Not at all. It's for growth, clarity, and everyday struggles too."
  },
  {
    question: "Will it actually help me?",
    answer: "With the right guidance, yes. It helps you understand and manage better. You don't have to figure it all out alone."
  }
];

const FAQ = () => {
  const [openIndex, setOpenIndex] = useState<number | null>(null);

  const toggleFAQ = (index: number) => {
    setOpenIndex(openIndex === index ? null : index);
  };

  return (
    <div className="min-h-screen bg-background">
      <Navbar />

      <section className="pt-32 pb-20 px-6">
        <div className="max-w-4xl mx-auto">
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            className="text-center mb-16"
          >
            <span className="text-primary font-body text-sm uppercase tracking-widest">FAQ</span>
            <h1 className="font-heading text-4xl md:text-5xl text-foreground mt-4 mb-6">
              Frequently Asked Questions
            </h1>
            <p className="text-muted-foreground font-body max-w-2xl mx-auto text-lg">
              Find answers to common questions about therapy and how we can help you on your journey to mental wellness.
            </p>
          </motion.div>

          <div className="space-y-4">
            {faqData.map((faq, index) => (
              <motion.div
                key={index}
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: index * 0.1 }}
                className="bg-card rounded-2xl border border-border overflow-hidden"
              >
                <button
                  onClick={() => toggleFAQ(index)}
                  className="w-full flex items-center justify-between p-6 text-left"
                >
                  <span className="font-heading text-lg text-foreground pr-4">
                    {faq.question}
                  </span>
                  <ChevronDown 
                    className={`w-5 h-5 text-muted-foreground flex-shrink-0 transition-transform duration-300 ${openIndex === index ? 'rotate-180' : ''}`} 
                  />
                </button>
                <AnimatePresence>
                  {openIndex === index && (
                    <motion.div
                      initial={{ height: 0, opacity: 0 }}
                      animate={{ height: "auto", opacity: 1 }}
                      exit={{ height: 0, opacity: 0 }}
                      transition={{ duration: 0.3 }}
                      className="overflow-hidden"
                    >
                      <div className="px-6 pb-6">
                        <p className="font-body text-muted-foreground leading-relaxed">
                          {faq.answer}
                        </p>
                      </div>
                    </motion.div>
                  )}
                </AnimatePresence>
              </motion.div>
            ))}
          </div>

          {/* CTA Section */}
          <motion.div
            initial={{ opacity: 0, y: 20 }}
            animate={{ opacity: 1, y: 0 }}
            transition={{ delay: 0.5 }}
            className="mt-16 bg-card rounded-3xl border border-border p-8 md:p-12 text-center"
          >
            <h2 className="font-heading text-2xl md:text-3xl text-foreground mb-4">
              Still have questions?
            </h2>
            <p className="font-body text-muted-foreground mb-8 max-w-xl mx-auto">
              We're here to help. Reach out to us directly and we'll get back to you as soon as possible.
            </p>
            <div className="flex flex-col sm:flex-row gap-4 justify-center">
              <a
                href="tel:+919827240324"
                className="inline-flex items-center justify-center gap-2 bg-primary text-primary-foreground px-6 py-3 rounded-full font-body hover:opacity-90 transition-opacity"
              >
                <Phone size={18} />
                Call 9827240324
              </a>
              <a
                href="https://wa.me/919827240324"
                target="_blank"
                rel="noopener noreferrer"
                className="inline-flex items-center justify-center gap-2 bg-green-500 text-white px-6 py-3 rounded-full font-body hover:opacity-90 transition-opacity"
              >
                <MessageCircle size={18} />
                WhatsApp
              </a>
            </div>
          </motion.div>
        </div>
      </section>

      <Footer />
    </div>
  );
};

export default FAQ;
